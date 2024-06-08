// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyCfipLI_XxkJdX5a5gQPOC3ZLZfa40z7OM",
  authDomain: "rwash-10.firebaseapp.com",
  projectId: "rwash-10",
  storageBucket: "rwash-10.appspot.com",
  messagingSenderId: "257665432211",
  appId: "1:257665432211:web:cd87db94b216d9dcf42b66",
  measurementId: "G-C2W9T8L1F5"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
