import "../css/app.css";
import "./bootstrap";

import L from "leaflet";
import "leaflet/dist/leaflet.css";
window.L = L;

import markerIcon2x from "leaflet/dist/images/marker-icon-2x.png";
import markerIcon from "leaflet/dist/images/marker-icon.png";
import markerShadow from "leaflet/dist/images/marker-shadow.png";

delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl: markerIcon2x,
    iconUrl: markerIcon,
    shadowUrl: markerShadow,
});

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

import "./pages/simulasi/deposito";
import "./pages/simulasi/kredit";
import "./pages/jaringan/jaringan";

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();
