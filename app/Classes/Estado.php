<?php

namespace App\Classes;

class Estado{

    private int $id_estado;
    private $nome;
    private int $status;
    private $create_date;
    private $update_date;

    /**
     * Get the value of id_estado
     */
    public function getId_estado()
    {
        return $this->id_estado;
    }

    /**
     * Set the value of id_estado
     *
     * @return  self
     */
    public function setId_estado($id_estado)
    {
        $this->id_estado = $id_estado;

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
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }
}
