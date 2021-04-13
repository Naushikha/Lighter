<div class="container">
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <div class="row">
            Are you sure you want delete? blah blah blah blah
        </div>
        <div class="row">
            <div class="one-half column">
                <button class="button-primary" onclick="hideModal()"> Cancel </button>
            </div>
            <div class="one-half column">
                <input class="button-red" type="submit" value="Delete" name="delete"> 
            </div>
        </div>
    </form>
</div>