const MemoryGame = {
    tileCount: 20,
    tileOnRow: 5,
    board: null,
    scoreDisplay: null,
    tiles: [],
    checkedTiles: [],
    moveCount: 0,
    images: [
        "images/1.jpg", "images/2.jpg", "images/3.jpg", "images/4.jpg", "images/5.jpg",
        "images/6.jpg", "images/7.jpg", "images/8.jpg", "images/9.jpg", "images/10.jpg"
    ],
    canSelect: true,
    matchedPairs: 0,

    tileClick(e) {
        if (this.canSelect) {
            const selectedTile = e.target;

            if (!this.checkedTiles[0] || (this.checkedTiles[0].dataset.index !== selectedTile.dataset.index)) {
                this.checkedTiles.push(selectedTile);
                selectedTile.style.backgroundImage = `url(${this.images[selectedTile.dataset.cardType]})`;
            }

            if (this.checkedTiles.length === 2) {
                this.canSelect = false;

                setTimeout(() => {
                    this.checkedTiles[0].dataset.cardType === this.checkedTiles[1].dataset.cardType
                        ? this.deleteTiles()
                        : this.resetTiles();

                }, 500);

                this.moveCount++;
                this.scoreDisplay.innerText = this.moveCount;
            }
        }
    },

    deleteTiles() {
        this.checkedTiles.forEach(tile => {
            const emptyDiv = document.createElement("div");
            tile.after(emptyDiv);
            tile.remove();
        });

        this.canSelect = true;
        this.checkedTiles = [];
        this.matchedPairs++;

        if (this.matchedPairs >= this.tileCount / 2) {
            alert("Gratulacje, wygrałeś!");
        }
    },

    resetTiles() {
        this.checkedTiles.forEach(tile => tile.style.backgroundImage = "");
        this.checkedTiles = [];
        this.canSelect = true;
    },

    startGame() {
        this.board = document.querySelector(".game-board");
        this.board.innerHTML = "";

        this.scoreDisplay = document.querySelector(".game-score");
        this.scoreDisplay.innerText = 0;

        this.tiles = [];
        this.checkedTiles = [];
        this.moveCount = 0;
        this.canSelect = true;
        this.matchedPairs = 0;

        for (let i = 0; i < this.tileCount; i++) {
            this.tiles.push(Math.floor(i / 2));
        }

        for (let i = this.tileCount - 1; i > 0; i--) {
            const swap = Math.floor(Math.random() * i);
            [this.tiles[i], this.tiles[swap]] = [this.tiles[swap], this.tiles[i]];
        }

        for (let i = 0; i < this.tileCount; i++) {
            const tile = document.createElement("div");
            tile.classList.add("game-tile");
            this.board.appendChild(tile);

            tile.dataset.cardType = this.tiles[i];
            tile.dataset.index = i;

            tile.addEventListener("click", e => this.tileClick(e));
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const startBtn = document.querySelector(".game-start");
    startBtn.addEventListener("click", () => MemoryGame.startGame());
});