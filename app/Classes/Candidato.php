<?php

namespace App\Classes;

Class Candidato{

    private int $id;
    private int $id_user;
    private string $cargo;
    private string $area;
    private string $apresentacao;
    private string $create_date;
    private string $update_date;
    private string $curriculo;
    private string $profissao;
    private int $status;

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
     * Get the value of cargo
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set the value of cargo
     *
     * @return  self
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }
    /**
     * Get the value of apresentacao
     */
    public function getApresentacao()
    {
        return $this->apresentacao;
    }

    /**
     * Set the value of apresentacao
     *
     * @return  self
     */
    public function setApresentacao($apresentacao)
    {
        $this->apresentacao = $apresentacao;

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

    /**
     * Get the value of area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set the value of area
     *
     * @return  self
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get the value of id_user
     */
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of curriculo
     */
    public function getCurriculo()
    {
        return $this->curriculo;
    }

    /**
     * Set the value of curriculo
     *
     * @return  self
     */
    public function setCurriculo($curriculo)
    {
        $this->curriculo = $curriculo;

        return $this;
    }

    /**
     * Get the value of profissao
     */
    public function getProfissao()
    {
        return $this->profissao;
    }

    /**
     * Set the value of profissao
     *
     * @return  self
     */
    public function setProfissao($profissao)
    {
        $this->profissao = $profissao;

        return $this;
    }
}

?>
