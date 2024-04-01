// Fetch and insert the header and footer using JavaScript
fetch('../../components/Header/header.php')
    .then(response => response.text())
    .then(html => document.getElementById('header').innerHTML = html);

fetch('../../components/Footer/footer.html')
    .then(response => response.text())
    .then(html => document.getElementById('footer').innerHTML = html);

// Fetch and insert the pagination using JavaScript
fetch('../../components/Pagination/pagination.html')
    .then(response => response.text())
    .then(html => document.getElementById('pagination').innerHTML = html);