# Utiliser Node.js 22.13.0
FROM node:22.13.0

# Définir le répertoire de travail
WORKDIR /app

# Copier uniquement les fichiers nécessaires pour installer les dépendances
COPY package*.json ./

# Nettoyer le cache npm et installer les dépendances
RUN npm cache clean --force && npm install

# Copier le reste des fichiers du projet
COPY . .

# Exposer le port Angular
EXPOSE 4200

# Lancer l'application Angular
CMD ["npm", "start"]
