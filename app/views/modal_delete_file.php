<div class="container">
    <form action="" method="post">
        <input type="hidden" name="sendResponse" value="delete_file">
        <input type="hidden" name="file" value="<?php echo $data; ?>">
        <div class="row">
            Are you sure you want delete the file <b><?php echo $data; ?></b>?
        </div>
        <div class="row">
            <div class="one-half column">
                <button class="button-primary" onclick="closeModal(this)"> Cancel </button>
            </div>
            <div class="one-half column">
            <button class="button-red" type="submit"> Delete </button>
            </div>
        </div>
    </form>
</div>