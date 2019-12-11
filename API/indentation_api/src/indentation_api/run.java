package indentation_api;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.io.InputStreamReader;
import org.json.simple.JSONObject;
import com.puppycrawl.tools.checkstyle.checks.javadoc.JavadocTag;


public class run {

    public static void main(String[] args) throws Exception {
        String filePath = "C:\\Users\\khmka\\Desktop\\test.java";
        new editText("C:\\Users\\khmka\\Desktop\\test.java");
        
        JavadocTag x= new JavadocTag(5, 6, filePath);

        String output = "";
        String line;
        double count = 0;
        JSONObject result = new JSONObject();

        try {

            Process process = Runtime.getRuntime().exec(
                    "java -jar ./lib/checkstyle-8.26-all.jar -c /google_checks.xml " + filePath);

            BufferedReader reader = new BufferedReader(new InputStreamReader(process.getInputStream()));

            while ((line = reader.readLine()) != null) {
                if (line.contains("[Indentation]") || line.contains("[CommentsIndentation]")) {
                    output += line;
                    count += 1;
                }
            }
            result.put("input", output);

        } catch (IOException e) {
            throw e;
        }

        double grade = 1.0 - (count / linesCount(filePath));
        result.put("Grade", grade);
        System.out.println(result);
    }

    public static double linesCount(String filePath) throws Exception {
        double counter = 0;
        String line;
        try {
            BufferedReader reader = new BufferedReader(new FileReader(filePath));
            while ((line = reader.readLine()) != null) {
                counter++;
            }
            reader.close();

        } catch (Exception e) {
            throw e;
        }
        return counter;
    }

}
