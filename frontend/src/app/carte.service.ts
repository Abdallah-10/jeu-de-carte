// src/app/carte.service.ts
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

// Définir l'interface Carte pour la typage
interface Carte {
  color: string;
  value: string;
}

@Injectable({
  providedIn: 'root'
})
export class CarteService {

  private apiUrl = 'http://localhost:8000/api';  // URL de ton API Symfony

  constructor(private http: HttpClient) { }

  // Récupérer la main non triée
  getMainNonTriee(): Observable<Carte[]> {
    return this.http.get<Carte[]>(`${this.apiUrl}/random-hand`);
  }

  // Récupérer la main triée
  sortHand(hand: Carte[]): Observable<Carte[]> {
    return this.http.post<Carte[]>(`${this.apiUrl}/sort-hand`, hand);
  }
}
