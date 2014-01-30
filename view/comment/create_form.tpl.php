<div class='comment-form'>

<form method=post>
    <fieldset>
    <legend>Lämna en kommentar</legend>
    <p><label>Kommentar:<br/><textarea name='content'><?=$content?></textarea></label></p>
    <p><label>Namn:<br/><input type='text' name='name' value='<?=$name?>'/></label></p>
    <p><label>Hemsida:<br/><input type='text' name='web' value='<?=$web?>'/></label></p>
    <p><label>Mail:<br/><input type='text' name='mail' value='<?=$mail?>'/></label></p>
    <p class=buttons><input type='submit' name='create' value='Kommentera'/>
        <input type='reset' value='Återställ'/>
        <input type='submit' name='delete' value='Ta bort alla kommentarer'/>
    </p>
    <output><?=$output?></output>
    </fieldset>
</form>

</div>
