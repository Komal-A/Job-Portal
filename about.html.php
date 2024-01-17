<h1>About Us</h1>
<p class="home">Welcome to Jo's Jobs.
    We try to keep all information up to date and accurate so you need to check often if we have best jobs matches to your choice.</p>


<section class="right">
<h3>Select the type of job you are looking for:</h3>

<?=
'<ul>';
foreach ($cats as $category) {
    echo '<li><a href="/Users/Jobs?category_id=' . $category->id . '"> ' . $category->name . ' </a></li>';
}
'</ul>';
?>
</li>
</section>