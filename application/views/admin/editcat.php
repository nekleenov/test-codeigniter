<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><? echo $get_category->name ?></h1>
    </div>
    <!-- /.col-lg-12 -->

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Редактируем категорию: <? echo $get_category->name ?>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <?php echo validation_errors().$error; ?>
                        <div class="form-group">
                            <label>Название категории</label>
                            <input class="form-control" type="text" value="<? echo $get_category->name ?>" name="edit_name">
                            <p class="help-block">Укажите новое название категории.</p>
                        </div>
                        <input type="submit" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->