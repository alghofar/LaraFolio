<?php

class AdminUsersControllerTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | Users Admin Tests
    |--------------------------------------------------------------------------
    */

    // GET /admin/users
    public function test_get_admin_users_page()
    {
        $this->beAdmin();

        $this->call('GET', route('admin.users.index'));
        $this->assertResponseOk();
    }

    // GET /admin/users/create
    public function test_get_admin_users_create_page()
    {
        $this->beAdmin();

        $this->call('GET', route('admin.users.create'));
        $this->assertResponseOk();
    }

    // POST /admin/users
    public function test_post_admin_users_store_form_bad_csrf_token()
    {
        $this->setExpectedException('Illuminate\Session\TokenMismatchException');
        $this->beAdmin();

        $response = $this->call('POST', URL::route('admin.users.store'));
    }

    public function test_post_admin_users_store_form_blank()
    {
        $this->beAdmin();

        $this->call('POST', URL::route('admin.users.store'), ['IgnoreCSRFTokenError' => true]);
        $this->assertRedirectedToRoute('admin.users.create');
        $this->assertSessionHas('errors');
    }

    // GET /admin/users/edit/1
    public function test_get_admin_users_edit_page_id_exists()
    {
        $this->beAdmin();

        $this->call('GET', route('admin.users.edit', 1));
        $this->assertResponseOk();
    }

    // GET /admin/users/edit/1337
    public function test_get_admin_users_create_page_id_not_found()
    {
        $this->setExpectedException('Tyloo\Exceptions\AdminUsersUserNotFoundException');
        $this->beAdmin();

        $this->call('GET', route('admin.users.edit', 1337));
        $this->assertRedirectedToRoute('admin.users.index');
        $this->assertSessionHas('error');
    }

}
