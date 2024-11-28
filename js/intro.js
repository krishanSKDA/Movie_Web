const movies = [
    {
        id: 1,
        title: 'Batman Returns',
        description: 'lorem ipsum dolor sit amet lore mauris, consectetur adipiscing elit sed diam nonumy eirmod tempor',
        image: 'assets/movie/batman.jpg'
    },
    {
        id: 2,
        title: 'Wild Wild West',
        description: 'lorem ipsum dolor sit amet lore mauris, consectetur adipiscing elit sed diam nonumy eirmod tempor',
        image: 'assets/movie/wild.jpg'
    },
    {
        id: 3,
        title: 'The Amazing Spiderman',
        description: 'lorem ipsum dolor sit amet lore mauris, consectetur adipiscing elit sed diam nonumy eirmod tempor.',
        image: 'assets/movie/spider.jpg'
    }
];

const movieGrid = document.getElementById('movieGrid');
const searchInput = document.getElementById('searchInput');
const cartGrid = document.getElementById('cartGrid');

// Fetch movies from the API
async function fetchMoviesFromAPI(query) {
    const response = await fetch(`http://api.tvmaze.com/search/shows?q=${query}`);
    const data = await response.json();
    return data.map(item => ({
        id: item.show.id,
        title: item.show.name,
        description: item.show.summary ? item.show.summary.replace(/<\/?[^>]+(>|$)/g, "") : 'No description available.',
        image: item.show.image ? item.show.image.medium : 'assets/movie/default.jpg'
    }));
}

// Create movie card element
function createMovieCard(movie) {
    const card = document.createElement('div');
    card.className = 'movie-card';
    card.innerHTML = `
        <div class="movie-image">
            <img src="${movie.image}" alt="${movie.title}">
            <button class="add-btn" data-id="${movie.id}">+</button>
            <button class="remove-btn" data-id="${movie.id}">×</button>
        </div>
        <div class="movie-info">
            <h3 class="movie-title">${movie.title}</h3>
            <p class="movie-description">${movie.description.substring(0, 100)}<span class="more-text">${movie.description.length > 100 ? movie.description.substring(100) : ''}</span></p>
            <button class="more-info-btn" data-id="${movie.id}">More Info</button>
        </div>
    `;
    return card;
}

// Create cart movie card element
function createCartMovieCard(movie) {
    const card = document.createElement('div');
    card.className = 'cart-card';
    card.innerHTML = `
        <h4>${movie.title}</h4>
        <p>${movie.description}</p>
    `;
    return card;
}

// Render movies in the grid
function renderMovies(moviesToRender) {
    movieGrid.innerHTML = '';
    moviesToRender.forEach(movie => movieGrid.appendChild(createMovieCard(movie)));
}

// Render cart movies
function renderCartMovies() {
    cartGrid.innerHTML = '';
    movies.forEach(movie => cartGrid.appendChild(createCartMovieCard(movie)));
}

// Handle search input
searchInput.addEventListener('input', async (e) => {
    const searchTerm = e.target.value.toLowerCase();
    const filteredMovies = movies.filter(movie =>
        movie.title.toLowerCase().includes(searchTerm)
    );

    if (searchTerm.trim() !== '') {
        const apiMovies = await fetchMoviesFromAPI(searchTerm);
        apiMovies.forEach(movie => {
            if (!movies.some(m => m.id === movie.id)) {
                movies.push(movie); 
            }
        });
        renderMovies([...filteredMovies, ...apiMovies]);
        renderCartMovies();
    } else {
        renderMovies(movies);
    }
});


movieGrid.addEventListener('click', (e) => {
    const id = parseInt(e.target.dataset.id);
    if (e.target.classList.contains('add-btn')) {
        const movieToAdd = movies.find(movie => movie.id === id);
        if (movieToAdd && !movies.some(movie => movie.id === id)) {
            movies.push(movieToAdd);
            renderMovies(movies);
            renderCartMovies();
        }
    }

    if (e.target.classList.contains('remove-btn')) {
        const index = movies.findIndex(movie => movie.id === id);
        if (index > -1) {
            movies.splice(index, 1);
            renderMovies(movies);
            renderCartMovies();
        }
    }

    if (e.target.classList.contains('more-info-btn')) {
        const descriptionElement = e.target.previousElementSibling;
        if (descriptionElement.classList.contains('expanded')) {
            descriptionElement.classList.remove('expanded');
            e.target.textContent = 'More Info';
            descriptionElement.querySelector('.more-text').style.display = 'none';
        } else {
            descriptionElement.classList.add('expanded');
            e.target.textContent = 'Show Less';
            descriptionElement.querySelector('.more-text').style.display = 'inline';
        }
    }
});


renderMovies(movies);
