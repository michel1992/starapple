<div id='zoeken'>
    <form method="post">
        <input type="hidden" name="controller" value="bezoeker" />
        <input type="hidden" name="action" value="toon" />
        <select name='zoekActiviteit'>
            <option value="" selected="selected">all</option>
            %zoekActiviteit% 
        </select>  
        <input type="submit" value="zoek" />
    </form>
</div> 