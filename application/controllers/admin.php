<?php
/*
 * ----------------------------------------------------------------------------
 * "THE BEER-WARE LICENSE" :
 * <thepixeldeveloper@googlemail.com> wrote this file. As long as you retain this notice you
 * can do whatever you want with this stuff. If we meet some day, and you think
 * this stuff is worth it, you can buy me a beer in return Mathew Davies
 * ----------------------------------------------------------------------------
 */
class Admin extends Controller {

    /**
     * index
     *
     * @return void
     * @author Trieu
     **/
    function index()
    {
        if(!$this->redux_auth->logged_in()){
            redirect("welcome/login");
        }
         $this->load->view('admin');
    }

}


