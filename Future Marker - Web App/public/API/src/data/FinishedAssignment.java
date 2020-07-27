package data;

import api.DB;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.sql.SQLException;
import java.util.Scanner;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import api.API;

public class FinishedAssignment {

    private static FinishedAssignment instance = new FinishedAssignment();

    private String user_id;
    private String assignment_id;
    private String assignment_dir;
    private String assignment_main;
    private int compilation_grade;
    private String compilation_feedback;
    private float style_grade;
    private String style_feedback;
    private int dynamic_test_grade;
    private String dynamic_test_feedback;
    private int feature_test_grade;
    private String feature_test_feedback;
    private int lines_count = -1;
    private String package_name;

    private FinishedAssignment() {
    }

    public static FinishedAssignment getInstance() {
        return instance;
    }

    public void setUser_id(String aStudent_ID) {
        user_id = aStudent_ID;
    }

    public void setAssignment_id(String aAssignment_ID) {
        assignment_id = aAssignment_ID;
    }

    public void setAssignment_dir(String aAssignment_dir) {
        assignment_dir = aAssignment_dir;
    }

    public void setCompilation_grade(int aCompilation_grade) {
        compilation_grade = aCompilation_grade;
    }

    public void setCompilation_feedback(String aCompilation_feedback) {
        compilation_feedback = aCompilation_feedback;
    }

    public void setStyle_grade(float aStyle_grade) {
        style_grade = aStyle_grade;
    }

    public void setStyle_feedback(String aStyle_feedback) {
        style_feedback = aStyle_feedback;
    }

    public int getStyle_grade() {
        return (int) style_grade;
    }

    public void setDynamic_test_grade(int aDynamic_test_grade) {
        dynamic_test_grade = aDynamic_test_grade;
    }

    public void setDynamic_test_feedback(String aDynamic_test_feedback) {
        dynamic_test_feedback = aDynamic_test_feedback;
    }

    public void setFeature_test_grade(int aFeature_test_grade) {
        feature_test_grade = aFeature_test_grade;
    }

    public void setFeature_test_feedback(String aFeature_test_feedback) {
        feature_test_feedback = aFeature_test_feedback;
    }

    public String getUser_id() {
        return user_id;
    }

    public String getAssignment_id() {
        return assignment_id;
    }

    public String getAssignment_dir() {
        return assignment_dir;
    }

    public int getCompilation_grade() {
        return compilation_grade;
    }

    public String getCompilation_feedback() {
        return compilation_feedback;
    }

    public int getDynamic_test_grade() {
        return dynamic_test_grade;
    }

    public String getDynamic_test_feedback() {
        return dynamic_test_feedback;
    }

    public int getFeature_test_grade() {
        return feature_test_grade;
    }

    public String getFeature_test_feedback() {
        return feature_test_feedback;
    }

    public void save() {
        try {
            String sql = "INSERT INTO `finished_assignments`(`user_id`, `assignment_id`, `assignment_dir`, `assignment_main`, `compilation_grade`, `compilation_feedback`, `style_grade`, `style_feedback`, `dynamic_test_grade`, `dynamic_test_feedback`, `feature_test_grade`, `feature_test_feedback`, `assignment_alert`) VALUES ('" + user_id + "', '" + assignment_id + "', '" + assignment_dir + "', '" + assignment_main + "', '" + compilation_grade + "', '" + compilation_feedback + "', '" + style_grade + "', '" + style_feedback + "', '" + dynamic_test_grade + "', '" + dynamic_test_feedback + "', '" + feature_test_grade + "', '" + feature_test_feedback + "', '" + 0 + "')";
            int result = DB.SQLStmt().executeUpdate(sql);
            if (result == 1) {
                System.out.println("true");
            } else {
                System.out.println("false");
            }
        } catch (SQLException e) {
            System.out.println(e.toString());
        }
    }

    public int getLines_count() {

        if (lines_count == -1) {
            String[] children = getAssignment_files();
            int counter = 0;
            String line;
            for (String child : children) {

                try {
                    BufferedReader reader = new BufferedReader(new FileReader(child));
                    while ((line = reader.readLine()) != null) {
                        counter++;
                    }
                    reader.close();
                    lines_count = counter;
                } catch (IOException e) {
                }
            }
            return counter;
        } else {
            return lines_count;
        }
    }

    public void tostring() {
        System.out.println("Student_ID=" + user_id);
        System.out.println("Assignment_ID=" + assignment_id);
        System.out.println("Assignment_dir=" + assignment_dir);
        System.out.println("Assignment_main=" + assignment_main);
        System.out.println("Compilation_grade=" + compilation_grade);
        System.out.println("Compilation_feedback=" + compilation_feedback);
        System.out.println("Style_grade=" + style_grade);
        System.out.println("Style_feedback=" + style_feedback);
        System.out.println("Dynamic_test_grade=" + dynamic_test_grade);
        System.out.println("Dynamic_test_feedback=" + dynamic_test_feedback);
        System.out.println("Feature_test_grade=" + feature_test_grade);
        System.out.println("Feature_test_feedback=" + feature_test_feedback);
        System.out.println("Lines_count=" + lines_count);
        System.out.println("package_name=" + getPackage_name());

    }

    public String getAssignment_main() {
        return assignment_main;
    }

    public boolean setAssignment_main(String assignment_dir) {
        String[] children = getAssignment_files();
        Pattern pattern = Pattern.compile("public\\s*static\\s*void\\s*main\\s*\\(\\s*String\\s*\\[\\]\\s*args\\s*\\)");
        Matcher matcher;
        StringBuilder fileString;
        Scanner myReader;
        for (String child : children) {
            fileString = new StringBuilder();
            try {
                myReader = new Scanner(new File(child));
                while (myReader.hasNextLine()) {
                    fileString.append("\n" + myReader.nextLine());
                }
                myReader.close();

            } catch (FileNotFoundException e) {

            }
            matcher = pattern.matcher(fileString);
            if (matcher.find()) {
                Matcher matcher2 = Pattern.compile("(?<=package)(\\s+)(\\w+)(\\s*)(?=\\;)").matcher(fileString);
                if (matcher2.find()) {
                    package_name = matcher2.group().replace(" ", "") + ".";
                } else {
                    package_name = "";
                }
                assignment_main = new File(child).getName();
                return true;
            } else {
                API.ready = false;
            }
        }
        return false;
    }

    public String[] getAssignment_files() {
        File dir = new File(assignment_dir);
        String[] children = dir.list();
        for (int i = 0; i < children.length; i++) {
            children[i] = assignment_dir + "/" + children[i];
        }
        return children;
    }

    /**
     * @return the package_name
     */
    public String getPackage_name() {
        return package_name;
    }
}
