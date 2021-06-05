var firebaseConfig = {
        apiKey: "AIzaSyBUfCCyDrPyLm1UUdgoW5-yDn_b04ki2c8",
        authDomain: "webimage-3efdd.firebaseapp.com",
        projectId: "webimage-3efdd",
        storageBucket: "webimage-3efdd.appspot.com",
        messagingSenderId: "262718430443",
        appId: "1:262718430443:web:ed08e51c0f9ab0d966b2ae",
        measurementId: "G-DE6F63D122"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    console.log(firebase)


function uploadimage() {
    const ref = firebase.storage().ref()

    const file = document.querySelector("#photo").files[0]

    const name = file.name

    const metadata = {
        contentType: file.type
    }

    const task = ref.child(name).put(file, metadata)

    task
        .then(snapshot => snapshot.ref.getDownloadURL())
        .then(url => {
            console.log(url)
            alert("Image Upload Successful")
            const image = document.querySelector('#image')
            image.scr = url
        })
}