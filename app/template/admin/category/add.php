<?php

use app\models\News;

if (isset($_POST['save'])) {
    $news = new News();
    $news->title = $_POST['title'];
    $news->content = $_POST['content'];
    $news->created_at = date('Y-m-d h:m:s');
    $news->username = $session->admin->username;
    $news->save();
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-8 order-md-1 center-block">
            <h4 class="mb-3">Add Category</h4>
            <form class="needs-validation" novalidate method="post">

                <div class="mb-3">
                    <label for="title">Category Title</label>
                    <div class="input-group">
                        <input name="title" type="text" class="form-control" id="title" placeholder="The Title of News"
                               required>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your the title of Category is required.
                        </div>
                    </div>
                </div>

    
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Preference</label>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="save">Save News</button>
            </form>
        </div>

    </div>
</div>
