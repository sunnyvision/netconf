<?php namespace Lamoni\NetConf\NetConfMessage\NetConfMessageRecv;

/**
 * Class NetConfMessageRecvAbstract
 * @package Lamoni\NetConf\NetConfMessage\NetConfMessageRecv
 */
abstract class NetConfMessageRecvAbstract
{

    /**
     * Holds the SimpleXMLElement'd response from the server
     *
     * @var SimpleXMLElement
     */
    protected $response;

    /**
     * Build our NetConfMessageRecv* instance
     *
     * @param $response
     */
    public function __construct($response)
    {

        $this->setResponse($response);

    }

    /**
     * Sets $response
     *
     * @param $response
     */
    public function setResponse($response)
    {

        $this->response = simplexml_load_string($response);

    }

    /**
     * Returns a FluidXML instance
     *   
     * @return \FluidXml\FluidXml
     */
    public function getFluidResponse() {
        return new \FluidXml\FluidXml($this->response);
    }

    /**
     * Returns JSON decoded response parsed from XML
     * 
     * @return array
     */
    public function getArrayResponse() {
        return json_decode(json_encode($this->response), true);
    }

    /**
     * Returns $response
     *
     * @return SimpleXMLElement
     */
    public function getResponse()
    {

        return $this->response;

    }

    /**
     * Magic method for handling as a string
     *
     * @return mixed
     */
    public function __toString()
    {

        return (string)$this->getResponse()->asXML();

    }

}