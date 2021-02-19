<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Товары</h1>
    </div>
    <!-- /.col-lg-12 -->

    <div class="panel panel-default">
        <div class="panel-heading">
            Список всех товаров / <a href="/admin/add/">Добавить товар</a>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th width="40">#</th>
                    <th width="50">Фото</th>
                    <th>Название</th>
                    <th width="150">Категория</th>
                    <th width="200">Дата создание</th>
                    <th width="200">Опции</th>
                </tr>
                </thead>
                <tbody>
                <?
                    foreach($get_products AS $row) {
                        ?>
                        <tr>
                            <td><? echo $row->id; ?></td>
                            <td>
                                <img src="<? echo $row->photo; ?>" width="50" />
                            </td>
                            <td><? echo $row->name; ?></td>
                            <td><? echo $row->name_category; ?></td>
                            <td><? echo mdate($date_format, $row->create); ?></td>
                            <td><a href="/admin/edit/<? echo $row->id; ?>"><i class="fa fa-edit"></i> Изменить</a> / <a href="/admin/?delete=<? echo $row->id; ?>"><i class="fa fa-trash"></i> Удалить</a> </td>
                        </tr>
                        <?
                    }
                ?>
                </tbody>
            </table>
        </div>

        </div>
    </div>

</div>
<!-- /.row -->