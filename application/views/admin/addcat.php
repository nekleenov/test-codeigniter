<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Добавляем категорию</h1>
    </div>
    <!-- /.col-lg-12 -->

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <form method="post">
                        <?php echo validation_errors().$error; ?>
                        <div class="form-group">
                            <label>Название категории</label>
                            <input class="form-control" type="text" placeholder="Название" name="edit_name">
                            <p class="help-block">Укажите новое название категории.</p>
                        </div>
                        <input type="submit" value="Добавить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->