<div class="container">
    <form action="" method="post">
        <input type="hidden" name="sendResponse" value="recursive_modals_2">
        <div class="row">
            Are you sure you want delete? blah blah blah blah
        </div>
        <div class="row">
            <div class="one-half column">
                <button class="button-primary" onclick="closeModal(this)"> Cancel </button>
            </div>
            <div class="one-half column">
            <button class="button-red" onclick="showModal('delete_big');"> Go Recursive Again! </button>
            </div>
        </div>
    </form>
</div>