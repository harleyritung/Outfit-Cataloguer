<h1 class="display-6">Filter Mode</h1>
<p>Filter by:</p>
<hr class="m-2">
<p class="mb-2">Formality</p>
<div class="form-check">
    <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckCasual" onclick="filter_casual()" disabled>
    <label class="form-check-label" for="flexCheckCasual">
        Casual
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckBusinessCasual" onclick="filter_businesscasual()" disabled>
    <label class="form-check-label" for="flexCheckBusinessCasual">
        Business casual
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckSemiFormal" onclick="filter_semiformal()" disabled>
    <label class="form-check-label" for="flexCheckSemiFormal">
        Semi-formal
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckFormal" onclick="filter_formal()" disabled>
    <label class="form-check-label" for="flexCheckFormal">
        Formal
    </label>
</div>

<div>
    <!-- Type Filtering -->
    <hr class="m-2">
    <p class="mb-2">Type</p>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckTop" onclick="filterTop()" disabled>
        <label class="form-check-label" for="flexCheckTop">
            Top
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckBottom" onclick="filterBottom()" disabled>
        <label class="form-check-label" for="flexCheckBottom">
            Bottom
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckDefault" onclick="filterFullbody()" disabled>
        <label class="form-check-label" for="flexCheckDefault">
            Full body
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckAccessory" onclick="filterAccessory()" disabled>
        <label class="form-check-label" for="flexCheckAccessory">
            Accessory
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckShoes" onclick="filterShoes()" disabled>
        <label class="form-check-label" for="flexCheckShoes">
            Shoes
        </label>
    </div>
</div>
<br>
<div class="text-end">
    <button type="button" class="btn btn-warning" onclick="switchToSearch();">Switch to Search Mode</button>
</div>