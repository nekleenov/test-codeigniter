<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Добавляем товар</h1>
    </div>
    <!-- /.col-lg-12 -->

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data">
                        <?php echo validation_errors().$error; ?>
                        <div class="form-group">
                            <label>Название</label>
                            <input class="form-control" type="text" value="<? echo $get_products->name; ?>" placeholder="Название" name="name">
                        </div>
                        <div class="form-group">
                            <label>Описание</label>
                            <textarea class="form-control" name="description" rows="5"><? echo $get_products->description; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Загруженное фото</label>
                            <div class="form-group">
                                <img src="<? echo $get_products->photo; ?>" width="150" border="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Обновить фото? (не выбирайте файл если не хотите обновлять)</label>
                            <div class="form-group">
                                <label>File input</label>
                                <input type="file" name="photo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            <select name="category" class="form-control" style="width: 250px;">
                                <?
                                foreach($get_category AS $row) {
                                    $selected = ($id_num == $row->id) ? "selected " : "";
                                    ?>
                                        <option <? echo $selected; ?> value="<? echo $row->id; ?>"><? echo $row->name; ?></option>
                                    <?
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->