<h1 class="display-6">Filter Mode</h1>
<p>Filter by:</p>
<hr class="m-2">
<p class="mb-2">Formality</p>
<div class="form-check">
    <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckCasual" onclick="filter_casual()">
    <label class="form-check-label" for="flexCheckCasual">
        Casual
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckBusinessCasual" onclick="filter_businesscasual()">
    <label class="form-check-label" for="flexCheckBusinessCasual">
        Business casual
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckSemiFormal" onclick="filter_semiformal()">
    <label class="form-check-label" for="flexCheckSemiFormal">
        Semi-formal
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckFormal" onclick="filter_formal()">
    <label class="form-check-label" for="flexCheckFormal">
        Formal
    </label>
</div>

<div hidden>
    <!-- Type Filtering -->
    <hr class="m-2">
    <p class="mb-2">Type</p>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckTop" onclick="filterTop()">
        <label class="form-check-label" for="flexCheckTop">
            Top
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckBottom" onclick="filterBottom()">
        <label class="form-check-label" for="flexCheckBottom">
            Bottom
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckDefault" onclick="filterFullbody()">
        <label class="form-check-label" for="flexCheckDefault">
            Full body
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckAccessory" onclick="filterAccessory()">
        <label class="form-check-label" for="flexCheckAccessory">
            Accessory
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckShoes" onclick="filterShoes()">
        <label class="form-check-label" for="flexCheckShoes">
            Shoes
        </label>
    </div>
</div>
<br>
<div class="text-end">
    <button type="button" class="btn btn-warning" onclick="switchToSearch();">Switch to Search Mode</button>
</div>