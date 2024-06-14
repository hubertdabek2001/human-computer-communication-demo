document.getElementById('registerForm').addEventListener('submit', async (event) => {
    event.preventDefault();
    const email = document.getElementById('registerEmail').value;
    const password = document.getElementById('registerPassword').value;
    const name = document.getElementById('registerName').value;

    const response = await fetch('api/register.php', {
        method: 'POST',
        body: new URLSearchParams({ email, password, name })
    });
    const result = await response.json();
    alert(result.message || result.error);
});

document.getElementById('loginForm').addEventListener('submit', async (event) => {
    event.preventDefault();
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;

    const response = await fetch('api/login.php', {
        method: 'POST',
        body: new URLSearchParams({ email, password })
    });
    const result = await response.json();
    alert(result.message || result.error);
});

document.getElementById('searchButton').addEventListener('click', async () => {
    const query = document.getElementById('searchQuery').value;

    const response = await fetch(`api/search.php?query=${query}`);
    const songs = await response.json();

    const searchResults = document.getElementById('searchResults');
    searchResults.innerHTML = '';
    songs.forEach(song => {
        const li = document.createElement('li');
        li.textContent = `${song.title} by ${song.artist}`;
        searchResults.appendChild(li);
    });

    const songList = document.getElementById('songList');
    songList.innerHTML = '';
    songs.forEach(song => {
        const option = document.createElement('option');
        option.value = song.id;
        option.textContent = `${song.title} by ${song.artist}`;
        songList.appendChild(option);
    });
});

document.getElementById('playlistForm').addEventListener('submit', async (event) => {
    event.preventDefault();
    const name = document.getElementById('playlistName').value;
    const songs = Array.from(document.getElementById('songList').selectedOptions).map(option => option.value);

    const response = await fetch('api/create_playlist.php', {
        method: 'POST',
        body: new URLSearchParams({ name, songs })
    });
    const result = await response.json();
    alert(result.message || result.error);
});