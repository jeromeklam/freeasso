# FreeAsso - Project Analysis & Documentation

> **Free Association Manager** — A comprehensive donation, sponsorship, and member management platform for NGOs/associations (notably Kalaweit animal sanctuaries).

---

## Table of Contents

1. [Architecture Overview](#1-architecture-overview)
2. [Tech Stack](#2-tech-stack)
3. [Project Structure](#3-project-structure)
4. [Backend (PHP)](#4-backend-php)
5. [Frontend (React)](#5-frontend-react)
6. [Database Schema](#6-database-schema)
7. [API Endpoints](#7-api-endpoints)
8. [Authentication & Authorization](#8-authentication--authorization)
9. [Business Domain](#9-business-domain)
10. [Infrastructure & DevOps](#10-infrastructure--devops)
11. [Future Roadmap](#11-future-roadmap)

---

## 1. Architecture Overview

```
┌─────────────────────────────────────────────────────────────────┐
│                        React Frontend                           │
│          (Redux, Axios, React-Bootstrap, JSON:API)              │
├─────────────────────────────────────────────────────────────────┤
│                     RESTful JSON:API (/api/v1/asso/*)           │
├─────────────────────────────────────────────────────────────────┤
│                     Middleware Pipeline                          │
│  IgnoreMethod → ApiNegociator → Broker → Auth → Profile → Scope│
├─────────────────────────────────────────────────────────────────┤
│                     Controllers (47+)                           │
├─────────────────────────────────────────────────────────────────┤
│                     Services (9)                                │
├─────────────────────────────────────────────────────────────────┤
│                     Models / StorageModels (50+)                │
├─────────────────────────────────────────────────────────────────┤
│                     MySQL / MariaDB                             │
└─────────────────────────────────────────────────────────────────┘
```

**Pattern:** Multi-tier MVC with RESTful API separation
**Multi-tenancy:** Group-based (`grp_id`) and Broker-based (`brk_id`) isolation
**Entry point:** `www/index.php` — single front controller

---

## 2. Tech Stack

### Backend
| Component          | Technology                                      |
|--------------------|-------------------------------------------------|
| Language           | PHP 8.2+ (framework), PHP 7.2+ (application)   |
| Framework          | FreeFW (custom, PSR-compliant)                  |
| Database           | MySQL / MariaDB                                 |
| Auth               | FreeSSO (custom SSO) + JWT (RSA) + OAuth2       |
| Email              | PHPMailer (SMTP via OVH)                        |
| PDF                | FPDI / TCPDF                                    |
| Spreadsheets       | PHPSpreadsheet / Box-Spout                      |
| HTTP Client        | Guzzle                                          |
| WebSocket          | Ratchet / React-ZMQ                             |
| Message Queue      | AMQP (RabbitMQ)                                 |
| Testing            | PHPUnit + Codeception                           |
| Static Analysis    | PHPStan                                         |
| Build              | Phing                                           |

### Frontend
| Component          | Technology                                      |
|--------------------|-------------------------------------------------|
| Framework          | React                                           |
| State Management   | Redux                                           |
| HTTP Client        | Axios                                           |
| UI Components      | React-Bootstrap-Front                           |
| Styling            | SCSS + Bootstrap                                |
| API Normalization  | jsonapi-front (JSON:API spec)                   |
| i18n               | React-Intl                                      |

### Infrastructure
| Component          | Technology                                      |
|--------------------|-------------------------------------------------|
| Containerization   | Docker Compose (PHP 8.2, Apache2, MariaDB)      |
| CI/CD              | Jenkins (Jenkinsfile)                            |
| Mail Testing       | Mailhog                                         |

---

## 3. Project Structure

### Main Application (`/var/www/html`)

```
/var/www/html/
├── www/                          # Web document root
│   ├── index.php                 # Single entry point (front controller)
│   └── .htaccess                 # URL rewriting
├── src/FreeAsso/                 # Application source code
│   ├── Controller/               # 47+ REST API controllers
│   ├── Model/                    # Domain models
│   │   ├── Base/                 # Abstract base model classes
│   │   ├── StorageModel/         # 50 DB-mapped model classes
│   │   └── Behavior/            # Relationship traits
│   ├── Service/                  # 9 business logic services
│   ├── Storage/                  # Data persistence layer
│   ├── Http/                     # HTTP / route loader
│   ├── Command/                  # CLI commands
│   ├── Console/                  # Console utilities
│   ├── resource/                 # Route definitions & resources
│   │   └── routes/restful/       # RESTful API route files
│   └── Constants.php             # Error codes, event names
├── config/                       # Configuration
│   ├── config.php                # Main config (DB, middleware, models)
│   └── ini.php                   # Server-specific initialization
├── app/                          # CLI entry points
│   ├── command.php               # CLI dispatcher
│   ├── tech.php                  # Technical operations
│   ├── websocket.php             # WebSocket server
│   ├── rabbit.php                # RabbitMQ consumer
│   └── socket.php                # Socket server
├── cache/                        # Generated cache (routes, properties)
├── log/                          # Runtime logs
├── tests/                        # PHPUnit + Codeception tests
├── docs/                         # Documentation, templates (ODT)
├── install/                      # Installation scripts
├── docker/                       # Docker setup scripts
├── vendor/                       # Composer dependencies
├── composer.json                 # PHP dependencies
├── build.xml                     # Phing build targets
├── docker-compose.yml            # Docker services
├── phpunit.xml                   # Unit test config
├── phpstan.neon                  # Static analysis config
└── Jenkinsfile                   # CI/CD pipeline
```

### FreeFW Library (`/var/www/composer/free`)

```
/var/www/composer/free/src/
├── FreeFW/         # Core framework (routing, DI, ORM, middleware, caching)
├── FreeSSO/        # Single Sign-On (auth, users, groups, roles, brokers)
├── FreeAPI/        # API integrations (INSEE, IGN)
├── FreeAdmin/      # Admin panel tools
├── FreeWF/         # Workflow engine
├── FreeWS/         # WebSocket support (WAMP2)
├── FreeOffice/     # Office document handling (mail, PDFs, spreadsheets)
└── FreeBusiness/   # Business tools
```

---

## 4. Backend (PHP)

### 4.1 Request Lifecycle

```
HTTP Request → www/index.php
  → Bootstrap (autoloader, config)
  → Middleware Pipeline:
      1. IgnoreMethod (priority 90)
      2. ApiNegociator (priority 70) — content negotiation
      3. FreeSSO Broker (priority 60) — SSO broker resolution
      4. AuthNegociator (priority 40) — authentication
      5. Profile (priority 35) — user profile loading
      6. Scope (priority 20) — permission scope check
      7. RouteHandler (priority 10) — route matching & dispatch
  → Controller → Service → Model/StorageModel → Database
  → JSON:API Response
```

### 4.2 Controllers (47+)

Key controllers in `src/FreeAsso/Controller/`:

| Controller              | Purpose                              |
|-------------------------|--------------------------------------|
| `Donation`              | Donation CRUD, matching, payments    |
| `Client`                | Donor/member management              |
| `Cause`                 | Cause/project management             |
| `Sponsorship`           | Recurring sponsorship management     |
| `Receipt`               | Tax receipt management               |
| `ReceiptGeneration`     | Receipt PDF generation               |
| `Certificate`           | Certificate management               |
| `CertificateGeneration` | Certificate PDF generation           |
| `Dashboard`             | Statistics & overview data           |
| `Session`               | Time period management               |
| `Site`                  | Location/site management             |
| `Movement`              | Financial movements                  |
| `AccountingHeader`      | Accounting headers                   |
| `AccountingLine`        | Accounting line items                |
| `Member`                | Member verification & conversion     |
| `Species`               | Species lookup data                  |
| `CauseType`             | Cause type classifications           |
| `PaymentType`           | Payment method types                 |
| `DonationOrigin`        | Donation source tracking             |

### 4.3 Services (9)

| Service                | Responsibilities                                            |
|------------------------|-------------------------------------------------------------|
| `DonationService`      | Session verification, donation validation, accounting sync  |
| `SponsorshipService`   | Sponsorship lifecycle management                            |
| `CauseService`         | Cause operations, sponsor retrieval, currency conversion    |
| `ClientService`        | Client operations                                           |
| `ReceiptService`       | Receipt generation logic                                    |
| `ReceiptGenerationService` | Complex receipt PDF generation                          |
| `AccountingService`    | Ledger management                                           |
| `SessionService`       | Period management                                           |
| `StatService`          | Statistics and reporting                                    |

### 4.4 Events

Custom domain events defined in `Constants.php`:
- `EVENT_NEW_DONATION` — triggered on new donation
- `EVENT_NEW_SPONSORSHIP` — triggered on new sponsorship
- `EVENT_END_CAUSE` — triggered when a cause ends
- `EVENT_END_SPONSORSHIP` — triggered when sponsorship ends
- `EVENT_USER_VALIDATION` — triggered on user validation

Events can be consumed via AMQP (RabbitMQ) for async processing.

---

## 5. Frontend (React)

### 5.1 Component Architecture

The frontend uses a **template-based generation system** (via `FreeFW/ReactJS/Generator.php`):

- **List.js** — Table views with pagination, sorting, filtering
- **Form.js** — Create/edit forms with validation
- **FilterPanel.js** — Advanced multi-field filtering
- **Input.js** — Form input components
- **InputPicker.js** — Autocomplete picker
- **InlineList.js** — Inline list editing
- **Search.js** — Quick search functionality

### 5.2 State Management (Redux)

```
Store
├── Actions (per entity)
│   ├── loadMore        — paginated data loading
│   ├── loadOne         — load single item
│   ├── createOne       — create new item
│   ├── updateOne       — update existing item
│   ├── delOne          — delete item
│   ├── setFilters      — apply filters
│   ├── setSort         — apply sorting
│   ├── updateQuickSearch — quick search
│   ├── onSelect        — item selection
│   ├── selectAll/None  — bulk selection
│   ├── exportAsTab     — export data
│   └── printOne        — print item
├── Reducers (per entity)
└── Selectors (per entity)
```

### 5.3 API Communication

- **HTTP Client:** Axios with request cancellation
- **Base URL:** `process.env.REACT_APP_BO_URL + '/v1/...'`
- **Normalization:** jsonapi-front (JSON:API spec compliant)
- **Pattern:** RESTful CRUD with includes for related data

---

## 6. Database Schema

### 6.1 Core Tables

```
┌─────────────────┐     ┌──────────────────┐     ┌─────────────────┐
│  freeasso_client │     │ freeasso_donation│     │  freeasso_cause  │
│  (Donors/Members)│────▶│  (Donations)     │◀────│  (Projects)      │
│                  │     │                  │     │                  │
│  cli_id (PK)     │     │  don_id (PK)     │     │  cau_id (PK)     │
│  cli_firstname   │     │  cli_id (FK)     │     │  cau_name        │
│  cli_lastname    │     │  cau_id (FK)     │     │  caut_id (FK)    │
│  cli_email       │     │  don_mnt         │     │  site_id (FK)    │
│  cli_phone       │     │  don_status      │     │  cau_from        │
│  cli_address*    │     │  pty_id (FK)     │     │  cau_to          │
│  grp_id (FK)     │     │  ses_id (FK)     │     │  grp_id (FK)     │
└────────┬─────────┘     │  grp_id (FK)     │     └────────┬─────────┘
         │               └──────────────────┘              │
         │                                                 │
         │     ┌────────────────────┐                      │
         └────▶│freeasso_sponsorship│◀─────────────────────┘
               │  (Recurring)       │
               │                    │
               │  spo_id (PK)       │
               │  cli_id (FK)       │
               │  cau_id (FK)       │
               │  spo_mnt           │
               │  spo_freq          │
               │  spo_from          │
               │  spo_to            │
               │  grp_id (FK)       │
               └────────────────────┘
```

### 6.2 All Identified Tables (~50)

| Table                              | Purpose                          |
|------------------------------------|----------------------------------|
| `freeasso_donation`                | Donation transactions            |
| `freeasso_client`                  | Donors / Members                 |
| `freeasso_cause`                   | Causes / Projects                |
| `freeasso_sponsorship`             | Recurring sponsorships           |
| `freeasso_receipt`                 | Tax receipts                     |
| `freeasso_receipt_generation`      | Receipt batch generation         |
| `freeasso_receipt_type`            | Receipt type definitions         |
| `freeasso_receipt_donation`        | Receipt-donation link            |
| `freeasso_receipt_type_cause_type` | Receipt type per cause type      |
| `freeasso_certificate`             | Donation certificates            |
| `freeasso_certificate_generation`  | Certificate batch generation     |
| `freeasso_session`                 | Time periods / sessions          |
| `freeasso_year`                    | Fiscal years                     |
| `freeasso_site`                    | Sites / Locations                |
| `freeasso_site_type`               | Site type classifications        |
| `freeasso_site_media`              | Site images / media              |
| `freeasso_cause_type`              | Cause type classifications       |
| `freeasso_cause_media`             | Cause images / media             |
| `freeasso_cause_movement`          | Cause movement tracking          |
| `freeasso_cause_sickness`          | Cause health records             |
| `freeasso_cause_growth`            | Cause growth tracking            |
| `freeasso_cause_link`              | Cause-to-cause relationships     |
| `freeasso_client_type`             | Client type classifications      |
| `freeasso_client_category`         | Client category classifications  |
| `freeasso_payment_type`            | Payment methods                  |
| `freeasso_donation_origin`         | Donation sources                 |
| `freeasso_species`                 | Animal species                   |
| `freeasso_subspecies`              | Animal subspecies                |
| `freeasso_family`                  | Taxonomic families               |
| `freeasso_sickness`                | Health condition definitions     |
| `freeasso_unit`                    | Units of measurement             |
| `freeasso_movement`                | Financial movements              |
| `freeasso_contract`                | Contracts                        |
| `freeasso_contract_media`          | Contract documents               |
| `freeasso_accounting_header`       | Accounting headers               |
| `freeasso_accounting_line`         | Accounting line items            |
| `freeasso_stat`                    | Statistics records               |

### 6.3 Multi-tenancy

Every core table includes:
- `grp_id` — Group ID (tenant isolation)
- `brk_id` — Broker ID (SSO broker isolation)

---

## 7. API Endpoints

### 7.1 URL Pattern

```
Base:  /api/v1/asso/{resource}

CRUD:
  GET     /v1/asso/{resource}                     — List (paginated, filtered)
  GET     /v1/asso/{resource}/{id}                — Get one
  POST    /v1/asso/{resource}                     — Create
  PUT     /v1/asso/{resource}/{id}                — Update
  DELETE  /v1/asso/{resource}/{id}                — Delete

Utilities:
  GET     /v1/asso/{resource}/autocomplete/{q}    — Autocomplete search
  POST    /v1/asso/{resource}/export              — Export data
  POST    /v1/asso/{resource}/print/{id}          — Print / PDF

Custom (Donation):
  PUT     /v1/asso/donation/matched/{id}          — Mark as manually matched
  PUT     /v1/asso/donation/unmatched/{id}        — Mark as unmatched
  PUT     /v1/asso/donation/paid/{id}             — Mark as paid
  GET     /v1/asso/donation/statistics            — Donation statistics
  GET     /v1/asso/donation/years                 — Available years

Dashboard:
  GET     /v1/asso/dashboard/stats                — Dashboard statistics
```

### 7.2 JSON:API Format

All responses follow JSON:API specification:
```json
{
  "data": {
    "type": "FreeAsso_Donation",
    "id": "123",
    "attributes": { ... },
    "relationships": {
      "client": { "data": { "type": "FreeAsso_Client", "id": "456" } },
      "cause":  { "data": { "type": "FreeAsso_Cause", "id": "789" } }
    }
  },
  "included": [ ... ]
}
```

---

## 8. Authentication & Authorization

### 8.1 FreeSSO Module

- **SSO Broker** system for cross-application authentication
- **JWT tokens** with RSA key pairs (360000s duration)
- **OAuth2** server implementation
- **Role-based access control** (RBAC)

### 8.2 Middleware Pipeline

All API requests pass through:
1. **Broker Middleware** — resolves SSO broker context
2. **AuthNegociator** — validates JWT / session tokens
3. **Profile Middleware** — loads user profile and permissions
4. **Scope Middleware** — checks OAuth2 scopes

### 8.3 Route Security

All API routes require `AUTH_IN` (authenticated user) by default.

---

## 9. Business Domain

### 9.1 Core Entities

```
Association (Group)
  ├── Members / Clients (donors, sponsors)
  ├── Causes (animals, projects, nature conservation)
  │   ├── Cause Types (classification)
  │   ├── Cause Media (photos, descriptions)
  │   ├── Health Records (sickness, growth)
  │   └── Movements (transfers between sites)
  ├── Donations
  │   ├── One-time donations
  │   ├── Linked to sponsorships (recurring)
  │   ├── Statuses: OK, WAIT, NEXT, NOK
  │   └── Verification: NONE, AUTO, MANUAL
  ├── Sponsorships (recurring commitments)
  │   ├── Frequency: MONTH, YEAR, OTHER
  │   └── Links Client ↔ Cause
  ├── Receipts (tax receipts for donors)
  │   └── Batch generation per year
  ├── Certificates (donation certificates)
  │   └── Batch generation
  ├── Sites (physical locations / sanctuaries)
  │   ├── Site Types
  │   └── Site Media
  ├── Sessions (time periods for tracking)
  └── Accounting (financial ledger)
      ├── Headers
      └── Lines
```

### 9.2 Domain-Specific Features

- **Animal Sanctuary Management** — Species, subspecies, families, health records, growth tracking
- **Donation Matching** — Manual and automatic verification of payments
- **Tax Receipt Generation** — Batch PDF generation for fiscal compliance
- **Certificate Generation** — Sponsorship/donation certificates
- **Multi-currency Support** — Input currency + database currency with conversion
- **Accounting Integration** — Ledger sync with donation records

### 9.3 Existing Dashboard

Current dashboard endpoint (`/v1/asso/dashboard/stats`) provides:
- `total_contract` — count of active contracts
- `total_cause` — count of active causes
- `total_site` — count of active sites
- `area_site` — total site area
- `clot_site` — total fencing/closures
- Active member/friend count from sponsorships

---

## 10. Infrastructure & DevOps

### 10.1 Docker Environment

```yaml
Services:
  - PHP 8.2 + Apache2 (application server)
  - MariaDB (database)
  - Mailhog (mail testing)
```

### 10.2 CI/CD (Jenkins)

Deployment targets: beta, test, pre-production, production

### 10.3 Build (Phing)

`build.xml` provides targets for:
- Composer install/update
- Test execution
- Code quality checks (PHPStan, PHPCS)
- Deployment

---

## 11. Future Roadmap

Planned enhancements (per user):

### 11.1 LLM Integration
- AI-assisted data analysis and insights
- Natural language queries on donation/member data
- Automated report generation
- Smart donor engagement suggestions

### 11.2 Enhanced Dashboard
- **Donation Dashboard** — trends, totals by period, forecasts, top donors
- **Member Dashboard** — growth, retention, activity metrics
- **Cause Dashboard** — funding progress, sponsor counts, health status
- **Financial Overview** — revenue streams, accounting summaries

### 11.3 New Features
- Advanced member management
- Donation campaign tracking
- Automated communication workflows
- Reporting and analytics engine

---

## Key Files Quick Reference

| Purpose                | Path                                              |
|------------------------|---------------------------------------------------|
| Entry point            | `www/index.php`                                   |
| Main config            | `config/config.php`                               |
| Routes                 | `src/FreeAsso/resource/routes/restful/`            |
| Controllers            | `src/FreeAsso/Controller/`                         |
| Models                 | `src/FreeAsso/Model/`                              |
| StorageModels (DB)     | `src/FreeAsso/Model/StorageModel/`                 |
| Services               | `src/FreeAsso/Service/`                            |
| Constants / Events     | `src/FreeAsso/Constants.php`                       |
| CLI commands           | `src/FreeAsso/Command/`                            |
| FreeFW framework       | `/var/www/composer/free/src/FreeFW/`               |
| FreeSSO auth           | `/var/www/composer/free/src/FreeSSO/`              |
| Docker config          | `docker-compose.yml`                               |
| Build config           | `build.xml`                                        |
