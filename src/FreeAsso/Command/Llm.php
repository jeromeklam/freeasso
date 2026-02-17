<?php

namespace FreeAsso\Command;

/**
 * LLM commands
 *
 * @author jeromeklam
 */
class Llm
{

    /**
     * Core FreeAsso models for LLM metadata generation
     */
    protected static $coreModels = [
        'FreeAsso_Donation'    => 'FreeAsso::Model::Donation',
        'FreeAsso_Client'      => 'FreeAsso::Model::Client',
        'FreeAsso_Cause'       => 'FreeAsso::Model::Cause',
        'FreeAsso_Sponsorship' => 'FreeAsso::Model::Sponsorship',
        'FreeAsso_Receipt'     => 'FreeAsso::Model::Receipt',
        'FreeAsso_Certificate' => 'FreeAsso::Model::Certificate',
        'FreeAsso_Session'     => 'FreeAsso::Model::Session',
        'FreeAsso_Site'        => 'FreeAsso::Model::Site',
        'FreeAsso_CauseType'   => 'FreeAsso::Model::CauseType',
        'FreeAsso_PaymentType' => 'FreeAsso::Model::PaymentType',
    ];

    /**
     * Generate LLM metadata markdown file for all core FreeAsso models
     *
     * Usage: php app/tech.php llm::generate --output=/path/to/output.md
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     */
    public function generateMetadata(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {
        $p_output->write("LLM Metadata generation START", true);

        $outputFile = $p_input->getAttribute('output');
        if (empty($outputFile)) {
            $outputFile = APP_ROOT . '/data/llm_metadata.md';
        }

        $config = \FreeFW\DI\DI::getShared('config');
        $logger = \FreeFW\DI\DI::getShared('logger');

        $generator = new \FreeFW\Service\LLMMetadataGenerator($config, $logger);

        $md = [];
        $md[] = '# FreeAsso LLM Metadata';
        $md[] = '';
        $md[] = 'Generated on ' . date('Y-m-d H:i:s');
        $md[] = '';
        $md[] = 'This file contains LLM-friendly metadata for all core FreeAsso models.';
        $md[] = 'It is used as context for natural language queries via Ollama.';
        $md[] = '';
        $md[] = '---';
        $md[] = '';

        $count = 0;
        foreach (self::$coreModels as $name => $diName) {
            $p_output->write("  Processing: " . $name, true);
            try {
                $model = \FreeFW\DI\DI::get($diName);
                $modelMd = $generator->toMarkdown($model);
                $md[] = $modelMd;
                $md[] = '';
                $md[] = '---';
                $md[] = '';
                $count++;
            } catch (\Throwable $e) {
                $p_output->write("  ERROR on " . $name . ": " . $e->getMessage(), true);
            }
        }

        // Load teachings from sys_llm_teaching
        $p_output->write("  Loading teachings...", true);
        $teachings = $this->loadTeachings($p_output);
        if (!empty($teachings)) {
            $md[] = '# Domain Knowledge (Teachings)';
            $md[] = '';
            $md[] = 'User-taught mappings for natural language queries.';
            $md[] = '';
            $md[] = '| Input | Resource | Filter | Description |';
            $md[] = '|-------|----------|--------|-------------|';
            foreach ($teachings as $teaching) {
                $input = $teaching['input'] ?? '';
                $resource = $teaching['resource'] ?? '';
                $filter = $teaching['filter_json'] ?? '';
                $desc = $teaching['description'] ?? '';
                $filter = str_replace('|', '\\|', $filter);
                $md[] = "| {$input} | {$resource} | `{$filter}` | {$desc} |";
            }
            $md[] = '';
            $md[] = '---';
            $md[] = '';
            $p_output->write("  Found " . count($teachings) . " teachings", true);
        } else {
            $p_output->write("  No teachings found", true);
        }

        $content = implode(PHP_EOL, $md);
        $dir = dirname($outputFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents($outputFile, $content);

        $p_output->write("Generated metadata for " . $count . " models", true);
        $p_output->write("Output: " . $outputFile, true);
        $p_output->write("LLM Metadata generation END", true);
    }

    /**
     * Load active teachings from sys_llm_teaching
     *
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     *
     * @return array
     */
    protected function loadTeachings(
        \FreeFW\Console\Output\AbstractOutput $p_output
    ): array {
        try {
            $results = \FreeFW\Model\LlmTeaching::find(['llmt_activ' => 1]);
            $teachings = [];
            foreach ($results as $record) {
                $teachings[] = [
                    'input'       => $record->getLlmtInput(),
                    'resource'    => $record->getLlmtResource(),
                    'filter_json' => $record->getLlmtFilterJson(),
                    'description' => $record->getLlmtDescription(),
                    'lang'        => $record->getLlmtLang(),
                ];
            }
            return $teachings;
        } catch (\Throwable $e) {
            $p_output->write("  WARNING: Could not load teachings: " . $e->getMessage(), true);
            return [];
        }
    }
}
