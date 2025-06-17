<form method="POST" action="/rekognition/compare" enctype="multipart/form-data">
    @csrf
    <label>Profile Photo: <input type="file" name="photo1" accept="image/*"></label><br>
    <label>Selfie: <input type="file" name="photo2" accept="image/*"></label><br>
    <button type="submit">Compare Faces</button>
</form>
