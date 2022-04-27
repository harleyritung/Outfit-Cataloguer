<h1 class="display-6">Search Mode</h1>
<p>Search for an article by name...</p>
<form method="post">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Enter your search here..." id="searchValue" name="searchValue" onkeypress="checkForEnter(event)" />
        <input type="submit" class="btn btn-primary" value="Search" id="searchBtn" name="searchBtn" />
    </div>
</form>
<br>
<div class="text-end">
    <button type="button" class="btn btn-warning" onclick="switchToFilter();">Switch to Filter Mode</button>
</div>
<br>