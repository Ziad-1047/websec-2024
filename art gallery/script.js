document.addEventListener('DOMContentLoaded', () => {
  fetch('artworks.php')
    .then(response => response.json())
    .then(artworks => {
      const artworksContainer = document.getElementById('artworks-container');
      artworks.forEach(artwork => {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${artwork.title}</td>
                        <td>${artwork.artist}</td>
                        <td>${artwork.description}</td>
                        <td>$${artwork.price}</td>
                        <td><button onclick="addToCart(${artwork.id})">Add to Cart</button></td>`;
        artworksContainer.appendChild(tr);
      });
    });
});

let cart = [];

function addToCart(artworkId) {
  cart.push(artworkId);
  alert('Added to Cart');
}
