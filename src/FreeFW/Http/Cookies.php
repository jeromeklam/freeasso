<?php
namespace FreeFW\Http;

/**
 * Cookies
 *
 * @author jeromeklam
 */
class Cookies implements \Countable, \Iterator, \ArrayAccess
{

    /**
     * Cookies
     * @var array
     */
    protected $cookies = [];

    /**
     *
     * {@inheritDoc}
     * @see \Iterator::next()
     */
    public function next() : void
    {
        next($this->cookies);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Iterator::valid()
     */
    public function valid() : bool
    {
        return key($this->cookies) !== null;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Iterator::current()
     */
    public function current() : mixed
    {
        return current($this->cookies);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Iterator::rewind()
     */
    public function rewind() : void
    {
        reset($this->cookies);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Countable::count()
     */
    public function count() : int
    {
        return count($this->cookies);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Iterator::key()
     */
    public function key() : mixed
    {
        $key = key($this->cookies);
        if ($key === null) {
            return false;
        }
        $cookie = $this->cookies[$key];
        return $cookie->getName();
    }

    /**
     *
     * {@inheritDoc}
     * @see \ArrayAccess::offsetGet()
     */
    public function offsetGet(mixed $offset) : mixed
    {
        return isset($this->cookies[$offset]) ? $this->cookies[$offset] : null;
    }

    /**
     *
     * {@inheritDoc}
     * @see \ArrayAccess::offsetExists()
     */
    public function offsetExists(mixed $offset) : bool
    {
        return isset($this->cookies[$offset]);
    }

    /**
     *
     * {@inheritDoc}
     * @see \ArrayAccess::offsetUnset()
     */
    public function offsetUnset(mixed $offset) : void
    {
        unset($this->cookies[$offset]);
    }

    /**
     *
     * {@inheritDoc}
     * @see \ArrayAccess::offsetSet()
     */
    public function offsetSet(mixed $offset, mixed $value) : void
    {
        if (is_null($offset)) {
            $this->cookies[] = $value;
        } else {
            $this->cookies[$offset] = $value;
        }
    }

    /**
     * Has
     *
     * @param string $key
     *
     * @return \FreeFW\Http\Cookie
     */
    public function has($key)
    {
        return isset($this->cookies[$key]);
    }

    /**
     * Add a cookie
     *
     * @param string $p_name
     * @param string $p_value
     *
     * @return \FreeFW\Http\Cookies
     */
    public function add($p_name, $p_value)
    {
        $cookie          = new \FreeFW\Http\Cookie($p_name, $p_value);
        $this->cookies[] = $cookie;
        return $this;
    }

    /**
     * Add cookies to response
     *
     * @param \Psr\Http\Message\ResponseInterface $p_response
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addToResponse(\Psr\Http\Message\ResponseInterface $p_response)
    {
        foreach ($this->cookies as $idx => $cookie) {
            $p_response = $p_response->withAddedHeader('Set-Cookie', (string)$cookie);
        }
        return $p_response;
    }
}
