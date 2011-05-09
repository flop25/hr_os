<div class="titrePage">
  <h2>hr OS</h2>
</div>

<form method="post" class="properties" action="" ENCTYPE="multipart/form-data" name="form" class="properties">
<div id="configContent">
  <fieldset id="mainConfCheck">
    <legend></legend>
      <ul>
        <li>
          <span class="property">{'Display page banner on home page'|@translate}</span>
          <input type="checkbox" name="foo[home]" value="true" {if $foo.home}checked="checked"{/if}>
        </li>
        <li>
          <span class="property">{'Display page banner on categories pages'|@translate}</span>
          <input type="checkbox" name="foo[categories]" value="true" {if $foo.categories}checked="checked"{/if}>
        </li>
        <li>
          <span class="property">{'Display page banner on picture page'|@translate}</span>
          <input type="checkbox" name="foo[picture]" value="true" {if $foo.picture}checked="checked"{/if}>
        </li>
        <li>
          <span class="property">{'Display page banner on other pages'|@translate}</span>
          <input type="checkbox" name="foo[other]" value="true" {if $foo.other}checked="checked"{/if}>
        </li>
      </ul>
  </fieldset>
</div>
<p><input class="submit" type="submit" value="{'Submit'|@translate}" name="submit" /></p>
</form>