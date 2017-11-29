<?php

final class Area
{
    
    private $id;
    private $nome;
    private $hectare;
    private $parceiro;
    private $nomeParceiro;
    private $parceiroId;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getHectare()
    {
        return $this->hectare;
    }

    /**
     * @return mixed
     */
    public function getNomeParceiro()
    {
        return $this->nomeParceiro;
    }

    /**
     * @return mixed
     */
    public function getParceiro()
    {
        return $this->parceiro;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param mixed $hectare
     */
    public function setHectare($hectare)
    {
        $this->hectare = $hectare;
    }

    /**
     * @param mixed 
     */
    public function setNomeParceiro($nomeParceiro)
    {
        $this->nomeParceiro = $nomeParceiro;
    }

    /**
     * @param mixed $parceiro
     */
    public function setParceiro($parceiro)
    {
        $this->parceiro = $parceiro;
    }
    /**
     * @return mixed
     */
    public function getParceiroId()
    {
        return $this->parceiroId;
    }

    /**
     * @param mixed $idParceiro
     */
    public function setParceiroID($parceiroId)
    {
        $this->parceiroId = $parceiroId;
    }


    
    
    
}

?>
