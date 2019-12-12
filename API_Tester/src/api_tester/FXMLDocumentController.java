package api_tester;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import net.lingala.zip4j.core.ZipFile;
import net.lingala.zip4j.exception.ZipException;

public class FXMLDocumentController implements Initializable {

    FileChooser fileChooser = new FileChooser();
    File file = null;
    Alert a = new Alert(AlertType.INFORMATION);
    Thread thread = null;
    int fileCounter = 0;

    @FXML
    Button okBtn = new Button();

    @FXML
    Label filePathLabel = new Label();

    @FXML
    TextArea outputTextArea = new TextArea();

    @FXML
    private void handleChooserbtn(ActionEvent event) {
        File tempFile = fileChooser.showOpenDialog(new Stage());
        if (tempFile != null) {
            this.file = tempFile;
            filePathLabel.setText(this.file.getPath());
        }
    }

    @FXML
    private void handleCancelbtn(ActionEvent event) {
        if (thread != null && thread.isAlive()) {
            thread.stop();
            okBtn.setDisable(false);
        }
    }

    @FXML
    private void handleOkbtn(ActionEvent event) throws IOException {

        if (file != null) {
            Runnable runnable = () -> {
                String ext = file.getName().substring(file.getName().lastIndexOf("."));
                if (ext.equals(".java")) {
                    String response = sendFileToHTTP(file.getPath());
                    try {
                        createResponseFile(file.getParent() + "/feedback.txt", response);
                    } catch (IOException ex) {
                        System.out.println(ex.toString());
                    }

                } else if (ext.equals(".zip")) {
                    try {
                        handleZipFile();
                    } catch (IOException ex) {
                        System.out.println(ex.toString());
                    }
                }
                okBtn.setDisable(false);

            };
            okBtn.setDisable(true);
            thread = new Thread(runnable);
            thread.setDaemon(true);
            thread.start();

        } else {
            a.setContentText("Please choose a file");
            a.show();
        }
    }

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        List<String> myExtentions = new ArrayList<>();
        myExtentions.add("*.java");
        myExtentions.add("*.zip");
        fileChooser.setTitle("Choose File");
        fileChooser.getExtensionFilters().addAll(
                new FileChooser.ExtensionFilter("java or zip", myExtentions));
        fileChooser.setInitialDirectory(
                new File(System.getProperty("user.home"))
        );
    }

    private String sendFileToHTTP(String filepath) {
        String urlTo = "http://localhost/API/assess.php";

        String filefield = "codeFile";

        HttpURLConnection connection = null;
        DataOutputStream outputStream = null;
        InputStream inputStream = null;

        String twoHyphens = "--";
        String boundary = "*****" + Long.toString(System.currentTimeMillis()) + "*****";
        String lineEnd = "\r\n";

        String result = "";
        int bytesRead, bytesAvailable, bufferSize;
        byte[] buffer;
        int maxBufferSize = 1 * 1024 * 1024;

        try {
            File file = new File(filepath);
            FileInputStream fileInputStream = new FileInputStream(file);

            URL url = new URL(urlTo);
            connection = (HttpURLConnection) url.openConnection();

            connection.setDoInput(true);
            connection.setDoOutput(true);
            connection.setUseCaches(false);

            connection.setRequestMethod("POST");
            connection.setRequestProperty("Connection", "Keep-Alive");
            connection.setRequestProperty("User-Agent", "Android Multipart HTTP Client 1.0");
            connection.setRequestProperty("Content-Type", "multipart/form-data; boundary=" + boundary);

            outputStream = new DataOutputStream(connection.getOutputStream());
            outputStream.writeBytes(twoHyphens + boundary + lineEnd);
            outputStream.writeBytes("Content-Disposition: form-data; name=\"" + filefield + "\"; filename=\"" + filepath + "\"" + lineEnd);
            outputStream.writeBytes("Content-Transfer-Encoding: binary" + lineEnd);
            outputStream.writeBytes(lineEnd);

            bytesAvailable = fileInputStream.available();
            bufferSize = Math.min(bytesAvailable, maxBufferSize);
            buffer = new byte[bufferSize];

            bytesRead = fileInputStream.read(buffer, 0, bufferSize);
            while (bytesRead > 0) {
                outputStream.write(buffer, 0, bufferSize);
                bytesAvailable = fileInputStream.available();
                bufferSize = Math.min(bytesAvailable, maxBufferSize);
                bytesRead = fileInputStream.read(buffer, 0, bufferSize);
            }

            outputStream.writeBytes(twoHyphens + boundary + twoHyphens + lineEnd);

            inputStream = connection.getInputStream();
            result = convertStreamToString(inputStream);

            fileInputStream.close();
            inputStream.close();
            outputStream.flush();
            outputStream.close();

            return result;
        } catch (Exception e) {
            return e.toString();
        }
    }

    private static String convertStreamToString(InputStream is) {
        BufferedReader reader = new BufferedReader(new InputStreamReader(is));
        StringBuilder sb = new StringBuilder();

        String line = null;
        try {
            while ((line = reader.readLine()) != null) {
                sb.append(line);
            }
        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            try {
                is.close();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
        return sb.toString();
    }

    public void handleZipFile() throws IOException {
        String destination = "tempFolder";
        try {
            ZipFile zipFile = new ZipFile(file.getAbsolutePath());
            zipFile.extractAll(destination);

            // File object 
            File maindir = new File(destination);

            if (maindir.exists() && maindir.isDirectory()) {
                // array for files and sub-directories  
                // of directory pointed by maindir 
                File arr[] = maindir.listFiles();

                // Calling recursive method 
                exploreFiles(arr, 0, 0);
            }
        } catch (ZipException e) {
            e.printStackTrace();
        }
    }

    public void exploreFiles(File[] arr, int index, int level) throws IOException {
        // terminate condition 
        if (index >= arr.length) {
            return;
        }

        // for files 
        if (arr[index].isFile()) {
            fileCounter++;
            String tempFilePath = arr[index].getPath();
            String response = sendFileToHTTP(tempFilePath);
            createResponseFile(arr[index].getParent() + "/feedback.txt", response);
            // for sub-directories 
        } else if (arr[index].isDirectory()) {
            int count = arr[index].listFiles().length;
            // recursion for sub-directories 
            File[] files = arr[index].listFiles();
            if (count <= 1) {
                exploreFiles(files, 0, level + 1);

            } else {
                File lastFile = files[0];
                for (int i = 1; i < files.length; i++) {
                    if (lastFile.getName().contains(" " + i)) {
                        lastFile = files[i];
                    }
                }
                exploreFiles(lastFile.listFiles(), 0, level + 2);
            }
        }
        // recursion for main directory 
        exploreFiles(arr, ++index, level);
    }

    public void createResponseFile(String filePath, String response) throws IOException {
        File file = new File(filePath);
        file.createNewFile();
        outputTextArea.appendText(filePath + "\n");
        //Write Content
        FileWriter writer = new FileWriter(file);
        writer.write(response);
        writer.flush();
        writer.close();
    }
}
