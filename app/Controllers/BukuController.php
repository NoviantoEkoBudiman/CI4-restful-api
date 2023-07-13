<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class BukuController extends ResourceController
{
    protected $modelName    = 'App\Models\Buku';
    protected $format       = 'json';
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = $this->model->findAll();
        if($data){
            $result = [
                'message'   => 'Success',
                'data'      => $data
            ];
            return $this->respond($result, 200);
        }else{
            $result = [
                'message'   => 'Failed',
                'data'      => 'Not found'
            ];
            return $this->failNotFound($result);
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $validate = $this->validate([
            'buku_judul'        => 'required',
            'buku_deskripsi'    => 'required'
        ]);

        if(!$validate){
            $result = [
                "message" => $this->validator->getErrors()
            ];
            return $this->failValidationError($result);
        }

        $save = $this->model->insert([
            'buku_judul' => esc($this->request->getVar("buku_judul")),
            'buku_deskripsi' => esc($this->request->getVar("buku_deskripsi")),
        ]);

        if($save){
            $result = [
                "message"   => "Success"
            ];
            return $this->respondCreated($result);
        }else{
            $result = [
                "message"   => 'Failed to save the data'
            ];
            return $this->fail($result, 400);
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $validate = $this->validate([
            "buku_judul"        => "required",
            "buku_deskripsi"    => "required"
        ]);

        if(!$validate){
            $response = [
                "message" => $this->validator->getErrors()
            ];
            $this->failValidationError($response);
        }

        $update = $this->model->update($id, [
            "buku_judul" => esc($this->request->getVar("buku_judul")),
            "buku_deskripsi" => esc($this->request->getVar("buku_deskripsi"))
        ]);

        if($update){
            $response = [
                "message"   => "Success"
            ];
            return $this->respond($update, 200);
        }else{
            $response = [
                "message" => "Failed"
            ];
            return $this->fail($response, 400);
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $delete = $this->model->delete($id);
        if($delete){
            $response = [
                "message" => "Data has been deleted"
            ];
            return $this->respondDeleted($response);
        }else{
            $response = [
                "message" => "Failed to delete data"
            ];
            return $this->fail($response, 400);
        }
    }
}
