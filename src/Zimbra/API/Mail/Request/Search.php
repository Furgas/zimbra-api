<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Struct\CalTZInfo;
use Zimbra\Soap\Struct\CursorInfo;

/**
 * Search request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Search extends MailSearchParams
{
    /**
     * Warmup: When this option is specified, all other options are simply ignored, so you can't include this option in regular search requests.
     * This option gives a hint to the index system to open the index data and primes it for search.
     * The client should send this warm-up request as soon as the user puts the cursor on the search bar.
     * This will not only prime the index but also opens a persistent HTTP connection (HTTP 1.1 Keep-Alive) to the server, hence smaller latencies in subseqent search requests.
     * Sending this warm-up request too early (e.g. login time) will be in vain in most cases because the index data is evicted from the cache due to inactivity timeout by the time you actually send a search request.
     * @var bool
     */
    private $_warmup;

    /**
     * Constructor method for Search
     * @param  bool $warmup
     * @param  string $query
     * @param  array $header
     * @param  CalTZInfo $tz
     * @param  string $locale
     * @param  CursorInfo $cursor
     * @param  bool $includeTagDeleted
     * @param  bool $includeTagMuted
     * @param  string $allowableTaskStatus
     * @param  int $calExpandInstStart
     * @param  int $calExpandInstEnd
     * @param  bool $inDumpster
     * @param  string $types
     * @param  string $groupBy
     * @param  bool $quick
     * @param  string $sortBy
     * @param  string $fetch
     * @param  bool $read
     * @param  int $max
     * @param  bool $html
     * @param  bool $needExp
     * @param  bool $neuter
     * @param  bool $recip
     * @param  bool $prefetch
     * @param  string $resultMode
     * @param  string $field
     * @param  int $limit
     * @param  int $offset
     * @return self
     */
    public function __construct(
        $warmup = null,
        $query = null,
        array $header = array(),
        CalTZInfo $tz = null,
        $locale = null,
        CursorInfo $cursor = null,
        $includeTagDeleted = null,
        $includeTagMuted = null,
        $allowableTaskStatus = null,
        $calExpandInstStart = null,
        $calExpandInstEnd = null,
        $inDumpster = null,
        $types = null,
        $groupBy = null,
        $quick = null,
        $sortBy = null,
        $fetch = null,
        $read = null,
        $max = null,
        $html = null,
        $needExp = null,
        $neuter = null,
        $recip = null,
        $prefetch = null,
        $resultMode = null,
        $field = null,
        $limit = null,
        $offset = null
    )
    {
        parent::__construct(
            $query,
            $header,
            $tz,
            $locale,
            $cursor,
            $includeTagDeleted,
            $includeTagMuted,
            $allowableTaskStatus,
            $calExpandInstStart,
            $calExpandInstEnd,
            $inDumpster,
            $types,
            $groupBy,
            $quick,
            $sortBy,
            $fetch,
            $read,
            $max,
            $html,
            $needExp,
            $neuter,
            $recip,
            $prefetch,
            $resultMode,
            $field,
            $limit,
            $offset
        );
        if(null !== $warmup)
        {
            $this->_warmup = (bool) $warmup;
        }
    }

    /**
     * Get or set warmup
     *
     * @param  bool $warmup
     * @return bool|self
     */
    public function warmup($warmup = null)
    {
        if(null === $warmup)
        {
            return $this->_warmup;
        }
        $this->_warmup = (bool) $warmup;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_warmup))
        {
            $this->array['warmup'] = $this->_warmup ? 1 : 0;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(is_bool($this->_warmup))
        {
            $this->xml->addAttribute('warmup', $this->_warmup ? 1 : 0);
        }
        return parent::toXml();
    }
}
