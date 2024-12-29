# YOUTUBEURR

Penses-idiot :
- symfony server:start


La commande yt-dlp --flat-playlist -J https://www.youtube.com/@Gurky
permet de récupérer toutes les infos nécessaires d'une chaine / playlistes :

- Infos générales
- Infos pour chaque vidéo

🔴 : infos récupérées de yt-dlp

- Médialist = liste de vidéo, soit chaine soit playliste
  - 🔴 id dans la bdd
  - 🔴 mediaListId : id sur youtube
  - 🔴 url : url youtube
  - 🔴 title : titre de la medialiste
  - 🔴 description : description de la chaine (pas pour playliste)
  - 🔴 tags : tableaux de tags liés à une chaine
  - 🔴 thumbnailUrl : url de la miniature principale de la médialiste
  - 🔴 channelTitle : titre de la chaine qui a uploadé la playlist (yt-dlp : channel)
  - 🔴 modifiedAt : date de dernière modification (yt-dlp : modified_date)
  - lastScannedAt : date de dernier scan fait par l'application
  - 🔴 mediaCount : nombre de vidéo de la médialist (yt-dlp : playlist_count)
  - 🔴 viewCount : nombre de vue de la médialist (yt-dlp : view_count)


29/12/21 : recréation d'un nouveau projet from scratch avec tout ce qu'on a appris des précédents.