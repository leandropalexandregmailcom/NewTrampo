<?php

namespace App\Classes;

Class CandidatoVaga{

    private $id;
    private $candidato;
    private $vaga;
    private $create_date;
    private $update_date;
    private $status;
    private $estado;
    private $empresa;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of candidato
     */
    public function getCandidato()
    {
        return $this->candidato;
    }

    /**
     * Set the value of candidato
     *
     * @return  self
     */
    public function setCandidato($candidato)
    {
        $this->candidato = $candidato;

        return $this;
    }

    /**
     * Get the value of vaga
     */
    public function getVaga()
    {
        return $this->vaga;
    }

    /**
     * Set the value of vaga
     *
     * @return  self
     */
    public function setVaga($vaga)
    {
        $this->vaga = $vaga;

        return $this;
    }

    /**
     * Get the value of create_date
     */
    public function getCreate_date()
    {
        return $this->create_date;
    }

    /**
     * Set the value of create_date
     *
     * @return  self
     */
    public function setCreate_date($create_date)
    {
        $this->create_date = $create_date;

        return $this;
    }

    /**
     * Get the value of update_date
     */
    public function getUpdate_date()
    {
        return $this->update_date;
    }

    /**
     * Set the value of update_date
     *
     * @return  self
     */
    public function setUpdate_date($update_date)
    {
        $this->update_date = $update_date;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }
}

?>
