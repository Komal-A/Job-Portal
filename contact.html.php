<h1>Contact Us</h1>
<section class= "right">
<form action="/Enquiry/contact" method="POST">
    <p>Fill an Enquiry Form and we will get back to you:</p>
    <input type="hidden" name="enquiry[id]" required value="<?= $enquiry->id ?? '' ?>" />
    <label>Name: </label><input type="name" name="enquiry[name]" required value="<?= $enquiry->name ?? '' ?>" />
    <label>Email: </label><input type="text" name="enquiry[email]" required value="<?= $enquiry->email ?? '' ?>" />
    <label>Telephone No: </label><input type="text" name="enquiry[phone_number]" required value="<?= $enquiry->phone_number ?? '' ?>" />
    <label>Enquiry: </label><textarea id="text" name="enquiry[enquiry]" rows="3" cols="40" required> <?= $enquiry->enquiry ?? '' ?></textarea>
    <input type="hidden" name="enquiry[response]" value="0" />
    <input type="submit" name="submit" value="submit" />
</section>
</form>