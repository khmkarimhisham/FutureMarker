package style;

import com.puppycrawl.tools.checkstyle.Main;
import data.Assignment;
import data.FinishedAssignment;
import java.io.BufferedReader;
import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintStream;
import java.io.StringReader;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class Style {

    private static float comment_grade;
    private static String comment_feedback;
    private static float indentation_grade;
    private static String indentation_feedback;
    private static float identifiers_grade;
    private static String identifiers_feedback;

    public static void check() {

        FinishedAssignment finishedAssignment = FinishedAssignment.getInstance();
        Assignment assignment = Assignment.getInstance();
        comment_check(finishedAssignment);
        indentation_check(finishedAssignment);
        finishedAssignment.setStyle_grade(Math.round(((comment_grade + indentation_grade + identifiers_grade) / 3) * Assignment.getInstance().getStyle_grade()));
        finishedAssignment.setStyle_feedback(comment_feedback + "#|#|#|#" + indentation_feedback + "#|#|#|#" + identifiers_feedback);
    }

    private static void comment_check(FinishedAssignment finishedAssignment) {

        String[] children = finishedAssignment.getAssignment_files();
        float count = 0;
        float lines = 0;
        BufferedReader br;
        String str;

        for (String child : children) {
            try {
                br = new BufferedReader(new FileReader(child)); // Creation of BufferedReader object

                CharSequence word1 = "//";
                CharSequence word2 = "*/";
                // Input word to be searched
                while ((str = br.readLine()) != null) {// Reading Content from the file

                    if (!str.isEmpty()) { // check if there is empty line
                        lines++;
                        if ((str.contains(word1)) || (str.contains(word2))) { // Search for the given word
                            count++; // If Present increase the count by one
                        }
                    }
                }
                br.close();
            } catch (IOException e) {

            }
        }

        if (lines != 0) {
            float comment_percentage = (count / lines);
            if (comment_percentage >= 0.15) {
                comment_grade = 1;
                comment_feedback = "Your comments made the code clear";
            } else {
                comment_grade = comment_percentage * 6.66f;
                comment_feedback = "You need to clarify your code by using more comments";
            }
        } else {
            comment_grade = 0;
            comment_feedback = "You need to clarify your code by using more comments";
        }
    }

    public static void indentation_check(FinishedAssignment finishedAssignment) {

        String[] children = finishedAssignment.getAssignment_files();

        int indentationCount = 0;
        String indentationOutput = "";
        int idenftifersCount = 0;
        String identifiersOutput = "";

//        int LineLengthCunt = 0;
//        String LineLengthOutput = "";
//        int MethodLengthCount = 0;
//        String MethodLengthOutput = "";
        for (String child : children) {

            try {
                String[] q = {"-c", "google_checksindeni.xml", child};
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

            } catch (IOException e) {
            }
        }

        float indentationGrade = 1 - ((float) indentationCount / (float) finishedAssignment.getLines_count());
        float identifiersGrade = 1 - ((float) idenftifersCount / (float) finishedAssignment.getLines_count());
//            float LineLengthGrade = 1 - ((float)LineLengthCount / (float)DoingAssignment.getLines_count());
//            float MethodLengthGrade = 1 - ((float)MethodLengthCount / (float)DoingAssignment.getLines_count());

        indentation_grade = indentationGrade;
        if (indentationOutput.isEmpty()) {
            indentation_feedback = "Your code is very clear";
        } else {
            indentation_feedback = indentation_msg(indentationOutput);
        }

        identifiers_grade = identifiersGrade;
        if (identifiersOutput.isEmpty()) {
            identifiers_feedback = "Your identifiers name are clear";
        } else {
            identifiers_feedback = identifiers_msg(identifiersOutput);
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
