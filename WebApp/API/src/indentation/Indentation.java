package indentation;

import api.DoingAssignment;
import com.puppycrawl.tools.checkstyle.Main;
import java.io.BufferedReader;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.PrintStream;
import java.io.StringReader;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class Indentation {

    public static void check() {

        String indentationOutput = "";
        String identifiersOutput = "";
//        String LineLengthOutput = "";
//        String MethodLengthOutput = "";

        int indentationCount = 0;
        int idenftifersCount = 0;
//        int LineLengthCunt = 0;
//        int MethodLengthCount = 0;

        try {
            String[] q = {"-c", "google_checksindeni.xml", DoingAssignment.getAssignment_dir()};
            ByteArrayOutputStream BAOS = new ByteArrayOutputStream();
            PrintStream PS = new PrintStream(BAOS);
            PrintStream oldPS = System.out;
            System.setOut(PS);
            Main.main(q);
            System.out.flush();
            System.setOut(oldPS);
            BufferedReader reader = new BufferedReader(new StringReader(BAOS.toString()));
            String line;
            while ((line = reader.readLine()) != null) {
                if (line.contains("[Indentation]") || line.contains("[CommentsIndentation]")) {
                    indentationOutput += line + "\n";
                    indentationCount += 1;
                } else if (line.contains("[AbbreviationAsWordInName]")) {
                    identifiersOutput += line + "\n";
                    idenftifersCount += 1;
                }

//                else if (line.contains("[LineLength]")) {
//                    LineLengthOutput +=  line + "\n";
//                    LineLengthCount += 1;
//                } else if (line.contains("[MethodLength]")) {
//                    MethodLengthOutput +=  line + "\n";
//                    MethodLengthCount += 1;
//                }
            }

            float indentationGrade = 1 - ((float) indentationCount / (float) DoingAssignment.getLines_count());
            float identifiersGrade = 1 - ((float) idenftifersCount / (float) DoingAssignment.getLines_count());
//            float LineLengthGrade = 1 - ((float)LineLengthCount / (float)DoingAssignment.getLines_count());
//            float MethodLengthGrade = 1 - ((float)MethodLengthCount / (float)DoingAssignment.getLines_count());

            DoingAssignment.setIndentation_grade(indentationGrade);
            if (indentationOutput.isEmpty()) {
                DoingAssignment.setIndentation_feedback("Your code is very clear");
            } else {
                DoingAssignment.setIndentation_feedback(indentation_msg(indentationOutput));

            }

            DoingAssignment.setIdentifiers_grade(identifiersGrade);
            if (identifiersOutput.isEmpty()) {
                DoingAssignment.setIdentifiers_feedback("Your identifiers name are clear");
            } else {
                DoingAssignment.setIdentifiers_feedback(identifiers_msg(identifiersOutput));
            }
            DoingAssignment.setStyle_grade();

        } catch (IOException e) {
        }

    }

    private static String indentation_msg(String x) {
        Pattern p = Pattern.compile("[0-9]{1,}\\:");
        Matcher m = p.matcher(x);
        String result = "";
        while (m.find()) {
            result += "Line " + m.group(0).replace(":", "") + " has incorrect indentation<br>";
        }
        return result;
    }

    private static String identifiers_msg(String x) {
        Pattern p = Pattern.compile("[0-9]{1,}\\:");
        Matcher m = p.matcher(x);
        String result = "";
        while (m.find()) {
            result += "The identifier name should be more obvious at line " + x.replace(":", "") + "<br>";
        }
        return result;
    }

}
