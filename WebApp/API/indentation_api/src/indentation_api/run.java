package indentation_api;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.io.InputStreamReader;
import org.json.simple.JSONObject;

public class run {

    public static void main(String[] args) throws Exception {
        String filePath = args[0];
        double codeLineCount = linesCount(filePath);
        JSONObject result = new JSONObject();

        String indentationOutput = "";
        String identifiersOutput = "";
        String LineLengthOutput = "";
        String MethodLengthOutput = "";

        double indentationCount = 0;
        double idenftifersCount = 0;
        double LineLengthCount = 0;
        double MethodLengthCount = 0;

        try {
            Process process = Runtime.getRuntime().exec(
                    "java -jar ./lib/checkstyle-8.26-all.jar -c google_checksindeni.xml " + filePath);

            BufferedReader reader = new BufferedReader(new InputStreamReader(process.getInputStream()));
            String line;

            while ((line = reader.readLine()) != null) {
                if (line.contains("[Indentation]") || line.contains("[CommentsIndentation]")) {
                    indentationOutput += line.substring(line.lastIndexOf("java:") + 5);
                    indentationCount += 1;

                } else if (line.contains("[AbbreviationAsWordInName]")) {
                    identifiersOutput += line.substring(line.lastIndexOf("java:") + 5);
                    idenftifersCount += 1;
                }else if (line.contains("[LineLength]")) {
                    LineLengthOutput += line.substring(line.lastIndexOf("java:") + 5);
                    LineLengthCount += 1;
                }else if (line.contains("[MethodLength]")) {
                    MethodLengthOutput += line.substring(line.lastIndexOf("java:") + 5);
                    MethodLengthCount += 1;
                }
            }
            result.put("Indentation output", indentationOutput);
            result.put("Identifiers output", identifiersOutput);
            result.put("LineLength output", LineLengthOutput);
            result.put("MethodLength output", MethodLengthOutput);
            
        } catch (IOException e) {
            throw e;
        }

        double indentationGrade = 1.0 - (indentationCount / codeLineCount);
        double identifiersGrade = 1.0 - (idenftifersCount / codeLineCount);
        double LineLengthGrade = 1.0 - (LineLengthCount / codeLineCount);
        double MethodLengthGrade = 1.0 - (MethodLengthCount / codeLineCount);
        result.put("Indentation Grade", indentationGrade);
        result.put("Identifiers Grade", identifiersGrade);
        result.put("ineLength Grade", LineLengthGrade);
        result.put("MethodLength Grade", MethodLengthGrade);
        
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
