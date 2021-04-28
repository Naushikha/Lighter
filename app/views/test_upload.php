<div class="container">
    <h1> File Browser </h1>
    <h4> Available files in uploads folder; </h4>
    <hr>
    <?php foreach ($data as $item) { ?>
        <div class="row">
            <div class="five columns">
                <a href="<?php echo BASEURL; ?>/public/uploads/<?php echo $item; ?>" target="_blank" style="text-decoration: none;">
                    <?php echo $item; ?> 
                </a>
            </div>
            <div class="two columns">
                <button onclick="showModal('delete_file', '', {name: '<?php echo $item; ?>'})">X</button>
            </div>
        </div>
    <?php } ?>
    <hr>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="sendResponse" value="upload_file">
        <label for="file"> Select file to upload </label>
        <input type="file" name="file" id="file" required>
        <input type="submit" value="Upload" class="button-primary">
    </form>

</div>

