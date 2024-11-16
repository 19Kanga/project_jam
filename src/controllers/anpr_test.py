import cv2
import numpy as np
import json
import time
from openalpr import Alpr
from geopy.geocoders import Nominatim
import tflite_runtime.interpreter as tflite
from datetime import datetime

# Initialize ALPR (set to your country code)
alpr = Alpr("us", "/etc/openalpr/openalpr.conf", "/usr/share/openalpr/runtime_data")
if not alpr.is_loaded():
    print("Error loading OpenALPR")
    exit()

# Load pre-trained vehicle make/model TensorFlow Lite model
interpreter = tflite.Interpreter(model_path="vehicle_model.tflite")
interpreter.allocate_tensors()

# Input: Pre-recorded video
def process_video(video_path):
    cap = cv2.VideoCapture(video_path)  # Load the video file
    if not cap.isOpened():
        print("Error: Could not open video file")
        return

    while cap.isOpened():
        ret, frame = cap.read()
        if not ret:
            break  # End of video
        
        # Save the captured frame locally for processing
        image_path = f"captured_image_{int(time.time())}.jpg"
        cv2.imwrite(image_path, frame)

        # Perform number plate recognition
        plate = recognize_plate(image_path)
        if plate:
            print(f"Recognized Plate: {plate}")

        # Perform vehicle make and model detection
        vehicle_make_model = analyze_vehicle(frame)
        print(f"Vehicle Make/Model: {vehicle_make_model}")

        # Detect car color
        vehicle_color = detect_color(frame)
        print(f"Vehicle Color: {vehicle_color}")

        # Generate timestamp for the frame
        timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")

        # Simulated GPS data (or leave as None if not available)
        gps_data = {"latitude": None, "longitude": None, "timestamp": timestamp}

        # Save data to JSON
        vehicle_data = {
            "timestamp": timestamp,
            "gps": gps_data,
            "number_plate": plate,
            "make_model": vehicle_make_model,
            "color": vehicle_color
        }
        save_data_to_json(vehicle_data)

        # Simulate real-time delay (optional, adjust as needed)
        time.sleep(1)

    cap.release()

def recognize_plate(image_path):
    results = alpr.recognize_file(image_path)
    if results['results']:
        plate = results['results'][0]['plate']
        return plate
    return None

def analyze_vehicle(image):
    # Resize and preprocess image for model
    img_resized = cv2.resize(image, (224, 224))
    input_data = np.expand_dims(img_resized, axis=0)
    input_data = input_data.astype(np.float32)
    
    input_details = interpreter.get_input_details()
    output_details = interpreter.get_output_details()
    
    interpreter.set_tensor(input_details[0]['index'], input_data)
    interpreter.invoke()
    
    output_data = interpreter.get_tensor(output_details[0]['index'])
    
    # Placeholder for actual mapping of output_data to make/model labels
    return "make_model_placeholder"

def detect_color(image):
    # Resize image for faster processing
    resized_image = cv2.resize(image, (100, 100))
    
    # Convert to HSV color space
    hsv_image = cv2.cvtColor(resized_image, cv2.COLOR_BGR2HSV)
    
    # Calculate color histogram
    hist = cv2.calcHist([hsv_image], [0], None, [180], [0, 180])
    dominant_color = np.argmax(hist)
    
    # Map dominant_color to actual color name (example mapping)
    if 0 <= dominant_color < 10:
        return "red"
    elif 10 <= dominant_color < 30:
        return "yellow"
    elif 30 <= dominant_color < 85:
        return "green"
    elif 85 <= dominant_color < 130:
        return "blue"
    else:
        return "unknown"

def save_data_to_json(data):
    with open('vehicle_data.json', 'a') as f:
        json.dump(data, f)
        f.write("\n")

def main(video_file):
    process_video(video_file)

if __name__ == "__main__":
    video_file = "your_video_file.mp4"  # Specify the path to your video file
    try:
        main(video_file)
    except KeyboardInterrupt:
        alpr.unload()
        print("Program terminated.")
