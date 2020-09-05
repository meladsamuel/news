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
            <h4 class="mb-3">Add News</h4>
            <form class="needs-validation" novalidate method="post">

                <div class="mb-3">
                    <label for="title">Title</label>
                    <div class="input-group">
                        <input name="title" type="text" class="form-control" id="title" placeholder="The Title of News"
                               required>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your the title of news is required.
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">The Content</label>
                    <textarea name="content" class="form-control" id="content" rows="3"></textarea>
                </div>

                <div class="custom-file">
                    <input name="file" type="file" class="custom-file-input" id="file">
                    <label class="custom-file-label" for="file">Upload cover for news</label>
                </div>
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Preference</label>
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="save">Save News</button>
            </form>
        </div>

    </div>
</div>
