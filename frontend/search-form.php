<form>
    <div style="display: flex; align-items: center;">
        <label for="location" style="margin-right: 10px;">Location:</label>
        <select id="location" name="location" required>
            <option value="6">Ahobilam</option>
            <option value="25">Amaravathi</option>
            <option value="13">Araku - Mayuri Hotel</option>
            <option value="14">Ananthagiri</option>
            <option value="15">Tyda Jungel Bells hotel</option>
            <option value="16">Araku Hill Resort</option>
            <option value="23">Dindi - Coconut Country Hotel</option>
            <option value="24">Dwaraka - Tirumala Hotel</option>
            <option value="38">Ettipothala</option>
            <option value="40">Gandikota</option>
            <option value="7">Gandikshethram</option>
            <option value="28">Horsely hills</option>
            <option value="41">Idupulapaya</option>
            <option value="3">Kadapa</option>
            <option value="31">Kailasnathkona</option>
            <option value="35">Sri Kalahasti</option>
            <option value="1">Kurnool</option>
            <option value="19">Lambasingi</option>
            <option value="10">Lepakshi</option>
            <option value="5">Mahanandi</option>
            <option value="36">Mypadu - Beach Resort</option>
            <option value="26">Nagarjunasagar Vijayapurisouth</option>
            <option value="34">Nellore</option>
            <option value="42">Votimitta</option>
            <option value="8">Orvakallu</option>
            <option value="48">Pulugudu</option>
            <option value="37">Srisailam</option>
            <option value="22">Suryalanka - Beach Resort</option>
            <option value="45">Tada - Flamingo Resort</option>
            <option value="20">Vijayawada - Bhavani Island</option>
            <option value="21">Vijayawada - Berm Park Hotel</option>
            <option value="11">Visakhapatnam - Yatrinivas Hotel</option>
            <!-- Add more location options -->
        </select>
        <label for="checkin" style="margin: 0 10px;">Check-in Date:</label>
        <input type="date" id="checkin" name="checkin" required>
        <label for "checkout" style="margin: 0 10px;">Check-out Date:</label>
        <input type="date" id="checkout" name="checkout" required>
        <button id="portfolio-posts-btn" type="button" style="margin-left: 10px;">Submit</button>
    </div>
</form>
<div id="portfolio-posts-container"></div>
