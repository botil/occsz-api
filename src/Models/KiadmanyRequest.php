<?php

namespace Occsz\OccszApi\Models;

class KiadmanyRequest
{
    /**
     * @var string
     * Kiadmány típusa
     * Lehetséges értékei: Nevjegy|Cegkivonat|Cegmasolat|Cegbizonyitvany|MerlegJegyzek|KozlemenyJegyzek|IratJegyzek
     * required
     */
    public $doku;

    /**
     * @var string
     * Lekérdezés típusa
     * Lehetséges értékei: adat|arajanlat
     * required
     */
    public $reqtip;

    /**
     * @var string
     * Adatlekérdezés  kimeneti formátuma
     * Lehetséges értékei: html|xml6|bizonyos esetekbe PDF
     * required
     */
    public $outformat;

    /**
     * @var string
     * Cégjegyzékszám
     * required
     */
    public $key;

    /**
     * @var string
     * Aláírás típusa
     * Lehetséges értékei: alairasnelkul|eszignoval|kozokirat
     * required
     */
    public $alairt;

    /**
     * @var string
     * Cégbizonyítvány típusa
     * Lehetséges értékei: kivonat|masolat
     * required
     */
    public $tipus;


    /**
     * @var string
     * Árajánlat formátuma
     * Lehetséges értékei: xml|html
     * required
     */
    public $format;

    /**
     * @var string
     * Cégbizonyítvány típusa
     * Lehetséges értékei: hu|en|de|cz|sk
     * required
     */
    public $LANG;

    public function toArray() {
        $result = [];
        if ($this->doku != null && \strlen($this->doku) > 0)
            $result['doku'] = $this->doku;

        if ($this->reqtip != null && \strlen($this->reqtip) > 0)
            $result['reqtip'] = $this->reqtip;

        if ($this->key != null && \strlen($this->key) > 0)
            $result['key'] = $this->key;

        if ($this->alairt != null && \strlen($this->alairt) > 0)
            $result['alairt'] = $this->alairt;

        if ($this->outformat != null && \strlen($this->outformat) > 0)
            $result['outformat'] = $this->outformat;

        if ($this->format != null && \strlen($this->format) > 0)
            $result['format'] = $this->format;

        if ($this->LANG != null && \strlen($this->LANG) > 0)
            $result['LANG'] = $this->LANG;

        return $result;
    }
}
