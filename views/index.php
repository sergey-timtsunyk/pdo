<div class="table" style="display: none"></div>
<button class="modal-district">добавить район</button>

<div id="overlay-popup-m1"></div>
<div id="m1-form" class="m1modal district-modal">
    <a class="close-m1"></a>
    <div>
        <div class="popup-m1-title">Добавить</div>
        <div class="popup-m1-cont"><div class="popup-m1-text1">Заполните все поля и нажмите добавить</div>
            <form class="popup-m1-form">
                <input type="text" name="name"        placeholder="Имя района" >
                <input type="text" name="population"  placeholder="Население" >
                <textarea name="description" id="" placeholder="Описание" cols="30" rows="10"></textarea>
                <input type="hidden" name="district" value="1">
                <button class="add-district">добавить</button>
            </form>
        </div></div></div>

<div id="overlay-popup-m1"></div>
<div id="m1-form" class="m1modal edit-modal">
    <a class="close-m1"></a>
    <div>
        <div class="popup-m1-title">Редактировать</div>
        <form class="popup-m1-form" enctype="multipart/form-data" onsubmit="return false;">
            <input type="text" name="name" placeholder="Имя района" >
            <input type="text" name="population"  placeholder="Население" >
            <textarea name="description" id="" placeholder="Описание" cols="20" rows="5"></textarea>
            <input type="hidden" name="district-edit" value="1">
            <input type="hidden" class="edit-id" name="id" value="">
            <div class="popup-m1-cont" style="display: none; padding: 10px; color: red"><div class="popup-m1-text1 validation">Заполните все поля и нажмите добавить</div></div>
            <button class="edit-district">сохранить</button>
        </form>
    </div>
</div>

<table class='new-table'><tr><th>id</th><th>Name</th><th>Population</th><th>Description</th><th>Редакт</th><th>Удалить</th></tr >
<?php
    /** @var District $value */
    foreach ($districts as $value) {
        echo "<tr><td class=\"id\">{$value->getId()}</td><td >{$value->getName()}</td>
        <td>{$value->getPopulation()}</td><td>{$value->getDescription()}</td><td><button class='edit'>редакт</button></td><td><button class='delete'>удалить</button></td></tr>";
    }
?>
</table>