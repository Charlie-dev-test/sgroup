<?php echo validation_errors(); ?>

<?php echo form_open('form'); ?>
    <label for="link">Ваша ссылка: </label>
    <input id="link" name="username" type="text">
    <br/>
    <input type="submit" value="Сократить">
</form>

<!--<input type="url">-->
<!--<button class="button">Сократить</button>-->