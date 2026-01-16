function trierTaches(colonne, critere) {
    const cards = Array.from(colonne.querySelectorAll('.card'));
    
    cards.sort((a, b) => {
        if(critere === 'priorite') {
            const textA = a.textContent;
            const textB = b.textContent;
            const prioA = parseInt(textA.match(/Priorité:\s*(\d+)/)?.[1] || 0);
            const prioB = parseInt(textB.match(/Priorité:\s*(\d+)/)?.[1] || 0);
            return prioB - prioA;
        } else if(critere === 'echeance') {
            const textA = a.textContent;
            const textB = b.textContent;
            const dateA = textA.match(/Échéance:\s*(\d{2}\/\d{2}\/\d{4})/)?.[1] || '31/12/2099';
            const dateB = textB.match(/Échéance:\s*(\d{2}\/\d{2}\/\d{4})/)?.[1] || '31/12/2099';
            const [jA, mA, aA] = dateA.split('/');
            const [jB, mB, aB] = dateB.split('/');
            return new Date(aA, mA-1, jA) - new Date(aB, mB-1, jB);
        }
    });
    
    cards.forEach(card => colonne.appendChild(card));
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.column').forEach(col => {
        const titre = col.querySelector('h2');
        const btnPrio = document.createElement('button');
        const btnDate = document.createElement('button');
        
        btnPrio.textContent = '📊 Priorité';
        btnDate.textContent = '📅 Date';
        btnPrio.className = 'btn-tri';
        btnDate.className = 'btn-tri';
        
        btnPrio.onclick = () => trierTaches(col, 'priorite');
        btnDate.onclick = () => trierTaches(col, 'echeance');
        
        titre.appendChild(document.createElement('br'));
        titre.appendChild(btnPrio);
        titre.appendChild(btnDate);
    });
});