const endDate = new Date();
endDate.setMinutes(endDate.getMinutes() + 25);

setInterval(updateTimer, 1000);

function updateTimer() {
    const now = new Date();
    const timeLeft = endDate - now;

    if (timeLeft < 0) {
        document.getElementById("timer").innerText = "Leilão Encerrado";
    } else {
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        document.getElementById("timer").innerText = `${minutes} minutos ${seconds} segundos`;
    }
}

const bidForm = document.getElementById("bid-form");
bidForm.addEventListener("submit", function(event) {
    event.preventDefault();
    const bidName = document.getElementById("bid-name").value;
    const bidAmount = parseInt(document.getElementById("bid-amount").value);
    const currentBid = parseInt(document.getElementById("current-bid").innerText);
    const minIncrement = 10;
    if (bidAmount >= currentBid + minIncrement) {
        document.getElementById("current-bid").innerText = bidAmount;
        addRankingEntry(bidName, bidAmount);
        saveBid(bidName, bidAmount);
        alert("Lance realizado com sucesso!");
    } else {
        alert("O lance deve ser maior que o lance atual mais o incremento mínimo.");
    }
});

function addRankingEntry(name, amount) {
    const row = document.createElement("tr");
    row.innerHTML = `<td>${name}</td><td>R$ ${amount}</td>`;
    document.getElementById("ranking-body").appendChild(row);
}

function saveBid(name, amount) {
    fetch('save_bid.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name, amount }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Lance salvo:', data);
    })
    .catch((error) => {
        console.error('Erro ao salvar lance:', error);
    });
}

function loadBids() {
    fetch('get_bids.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(bid => {
            addRankingEntry(bid.name, bid.amount);
        });
    })
    .catch((error) => {
        console.error('Erro ao carregar lances:', error);
    });
}

loadBids();
