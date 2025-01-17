<?php
$ret="const imageUpload = document.getElementById('imageUpload')

Promise.all([
    faceapi.nets.faceRecognitionNet.loadFromUri('recognition/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('recognition/models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('recognition/models')
    ]).then(start)

async function start(){
    const container = document.createElement('div')
    container.style.position = 'relative'
    document.body.append(container)
    const labeledFaceDescriptors = await loadLabeledImages()
    const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.5)
    let image, canvas

    var stdiv = document.getElementById('status');

    stdiv.innerHTML='โหลดเสร็จแล้ว';

    imageUpload.addEventListener('change', async () => {
        if (image) image.remove()
        if (canvas) canvas.remove()
        image = await faceapi.bufferToImage(imageUpload.files[0])
        container.append(image)
        canvas = faceapi.createCanvasFromMedia(image)
        container.append(canvas)
        const displaySize = { width: image.width, height: image.height }
        faceapi.matchDimensions(canvas, displaySize)
        const detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors()
        const resizedDetections = faceapi.resizeResults(detections, displaySize)
        const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
        results.forEach((result, i) => {
            const box = resizedDetections[i].detection.box
            //const options = { boxColor: \"#FF80AA\" }
            const drawBox = new faceapi.draw.DrawBox(box, { boxColor: \"#0000FF\",label: result.toString() })
            drawBox.draw(canvas)
          })
    })
}

function loadLabeledImages() {
    const labels = ['Jisoo', 'naowarut', 'mookda', 'wachi','chaowalit','prayut','sutee','bee','vipavadee']
    return Promise.all(
        labels.map(async label => {
            const descriptions = []
            
    var stdiv = document.getElementById('status');

            for (let i = 1; i <= 5; i++) {
                const img = await faceapi.fetchImage(`recognition/labeled_images/\${label}/\${i}.jpg`)
                const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                descriptions.push(detections.descriptor)
                
              stdiv.innerHTML=`วิเคราะห์รูป \${label} (\${i}/5)`; 
              }
                
        return new faceapi.LabeledFaceDescriptors(label, descriptions)
    })
  )
}
  ";
  print $ret; 