import { Component, OnInit } from '@angular/core';
import { CarteService } from './carte.service'; // Assurez-vous que ce service existe
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  standalone: true, // Si vous utilisez des composants autonomes, gardez cette option
  imports: [CommonModule], // Ajoutez CommonModule ici pour utiliser *ngIf et *ngFor
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  randomHand: any[] = [];  // Assurez-vous que c'est un tableau pour itérer dessus
  sortedHand: any[] = [];  // Pour stocker les cartes triées
  selectedCards: Set<any> = new Set(); // Si vous souhaitez gérer la sélection de plusieurs cartes

  constructor(private apiService: CarteService) { }

  ngOnInit(): void {
    // Appeler l'API lors de l'initialisation du composant
    this.apiService.getMainNonTriee().subscribe(
      (data: any[]) => {
        this.randomHand = data;
        console.log(this.randomHand);  // Vérifiez les données
      },
      error => {
        console.error('Erreur lors de la récupération des données', error);
      }
    );
  }

  toggleSelected(card: any): void {
    card.selected = !card.selected;  // Change l'état de sélection de la carte
  }

  // Méthode pour trier les cartes
  sortCards(): void {
    this.apiService.sortHand(this.randomHand).subscribe(
      (sortedCards: any[]) => {
        this.sortedHand = sortedCards; // Mettre à jour les cartes triées
        console.log('Cartes triées', this.sortedHand);
      },
      error => {
        console.error('Erreur lors du tri des cartes', error);
      }
    );
  }
}
