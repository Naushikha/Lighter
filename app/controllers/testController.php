<?php

class testController extends Controller
{
    public function __view()
    {
        $this->Talert('You sent the message: ');
        $this->Talert('You sent the message: You sent the message: You sent the message: ', 'red');
        $this->Talert('You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: ', 'green');
        $this->Tview('Test', 'home');
    }

    public function view()
    {
        $this->TcheckModals();
        echo 'You reached the test controller view method!';
    }

    public function upload()
    {
        $this->TcheckModals();
        $this->TcheckResponses();
        $data = array_diff(scandir(UPLOAD_PATH), ['.', '..']);
        $this->Tview('Test Upload', 'test_upload', '', $data);
    }

    protected function upload_modal_delete_file()
    {
        $filename = $_POST['name'];
        $this->Tmodal('Delete File', 'delete_file', '', $filename);
    }

    protected function upload_resp_delete_file()
    {
        $filename = $_POST['file'];
        $this->load->helper('lighterUploads');
        lighterRemoveUpload($filename);
        $this->Talert('Deleted file '.$filename.'!');
        lighterRedirect('test/upload');
    }

    protected function upload_resp_upload_file()
    {
        $this->load->helper('lighterUploads');
        if (lighterTempUploadExists('file')) {
            $filename = lighterStoreUpload('file');
            $this->Talert('File uploaded! New name is '.$filename, 'green');
            lighterRedirect('test/upload');
        } else {
            $this->Talert('File upload failed!', 'red');
            lighterRedirect('test/upload');
        }
    }
}
