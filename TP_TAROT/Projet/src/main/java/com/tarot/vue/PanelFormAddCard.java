package com.tarot.vue;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.tarot.model.ArcanesMajestueuses;
import com.tarot.model.ArcanesMajeures;
import com.tarot.model.ArcanesMineures;
import com.tarot.model.Card;

import javax.imageio.ImageIO;
import javax.swing.*;
import javax.swing.border.EmptyBorder;
import javax.swing.border.LineBorder;
import javax.swing.filechooser.FileNameExtensionFilter;
import java.awt.*;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.io.Reader;
import java.util.ArrayList;

public class PanelFormAddCard extends JPanel implements IGotBtnClickable, IGotComboxChange{

    GridBagLayout gbL = new GridBagLayout();
    GridBagConstraints gbCCurrentPanel = new GridBagConstraints();//constraints for this

    private final JLabel titleAddCard = new JLabel("Ajoutez une carte ici");
    private final JPanel panelForTitleAddCard = new JPanel(new BorderLayout());

    GridBagConstraints gbC = new GridBagConstraints();//constraint for form panel
    private final JPanel form = new JPanel();

        private JComboBox comboBoxDefaultCard;

            private final JLabel labelArcanesType = new JLabel("Types d'arcane : ");
            private final JComboBox comboBoxArcanesType = new JComboBox();
                String labelsArcanesType[] = {"Choisissez...","Arcanes Majeures", "Arcanes Mineures", "Arcanes Majestueuses"};
                private final DefaultComboBoxModel modelArcanesType = new DefaultComboBoxModel(labelsArcanesType);

        private final GridBagConstraints gbCPanelSwitched = new GridBagConstraints();//constraint for the panel that can be switch
        private final JPanel switchedPanel = new JPanel(new CardLayout());

            private final JPanel majeurePropertiesPanel = new JPanel(new GridBagLayout());
                private final JLabel labelElement = new JLabel("Element : ");
                private final JComboBox comboBoxElement = new JComboBox();
                    String elementsModel[] = {"Choisissez...","Feu", "Terre", "Air","Eau","Tous"};
                    private final DefaultComboBoxModel modelElement = new DefaultComboBoxModel(elementsModel);
                private final JLabel labelSortOf = new JLabel("Genre  :");
                private final JComboBox comboBoxSortOf = new JComboBox();
                    String sortOfModel[] = {"Choisissez...","Masculin", "Féminin", "Androgine","Neutre"};
                    private final DefaultComboBoxModel modelSortOf = new DefaultComboBoxModel(sortOfModel);

            private JPanel mineurePropertiesPanel = new JPanel(new GridBagLayout());
                private final JLabel labelDomain = new JLabel("Domaine : ");
                private final JComboBox comboBoxDomain = new JComboBox();
                    String domainModel[] = {"Choisissez...","Coupes", "Epées", "Batons","Deniers"};
                    private final DefaultComboBoxModel modelDomain = new DefaultComboBoxModel(domainModel);
                private final JLabel labelNumber = new JLabel("Numèro : ");
                private final JComboBox comboBoxNumber = new JComboBox();
                    String numberModel[] = {"Choisissez...", "As", "2", "3", "4", "5", "6", "7", "8", "9","10", "Valet", "Cavalier", "Reine", "Roi"};
                    private final DefaultComboBoxModel modelNumber = new DefaultComboBoxModel(numberModel);

            private final JPanel majestueusesPropertiesPanel = new JPanel(new GridBagLayout());
                private final JLabel labelPlanet = new JLabel("Planéte : ");
                private final JComboBox comboBoxPlanet = new JComboBox();
                    String planetModel[] = {"Choisissez...", "Terre", "Mars", "Uranus", "Jupiter", "Mercure", "Venus", "Saturne", "Neptune"};
                    private final DefaultComboBoxModel modelPlanet = new DefaultComboBoxModel(planetModel);

        private final JLabel name = new JLabel("Nom :");
        private final JTextField textFieldName = new JTextField("Nom de la carte");
        private final JLabel num = new JLabel("Numéro :");
        private final JTextField textFieldNum= new JTextField("Numéro de la carte");

        private final JLabel addImageLabel = new JLabel("Ajouter une image");
        private final JTextField textFieldAddImage = new JTextField("URL de l'image");
        private final JButton btnAddImage = new JButton("Ouvrir l'explorateur de fichier");
        private final JButton btnSubmit = new JButton("Ajouter la carte");
        private final JButton btnEmpty = new JButton("Réinitialiser le formulaire");

    private final JLabel errorFormField = new JLabel();


    public PanelFormAddCard(){
        super();
        this.setBackground(new Color(54,54,58));
        this.setBorder(new EmptyBorder(10,0,5,0));
        this.setLayout(gbL);
        initComponent();
        this.putBtnToHashMapClikable();

    }

    /**
     * Init properties and style of all required components
     */
    private void initComponent(){
        //Define properties of title panel
        this.titleAddCard.setForeground(Color.WHITE);
        this.titleAddCard.setHorizontalTextPosition(SwingConstants.CENTER);
        this.titleAddCard.setHorizontalAlignment(SwingConstants.CENTER);
        this.titleAddCard.setBorder(new EmptyBorder(15,0,15,0));
        this.panelForTitleAddCard.setBackground(new Color(3,3,32));
        this.panelForTitleAddCard.add(this.titleAddCard);

        //Define properties of the form panel

        this.form.setBackground(new Color(50,51,50));
        this.form.setLayout(this.gbL);
        this.form.setPreferredSize(new Dimension(-1 ,100));
        this.form.setMaximumSize(new Dimension(-1 , 100));

            //Define constraints to add title panel to his parent(this)
            this.gbCCurrentPanel.gridx = 0;
            this.gbCCurrentPanel.gridy= 0;
            this.gbCCurrentPanel.gridheight = 1;
            this.gbCCurrentPanel.weightx = 1;
            this.gbCCurrentPanel.weighty = 0.02;
            this.gbCCurrentPanel.fill = GridBagConstraints.BOTH;
            this.gbCCurrentPanel.anchor = GridBagConstraints.FIRST_LINE_START;
            this.add(this.panelForTitleAddCard,this.gbCCurrentPanel);

            //Components added to the form
            //Constraints for comboBoxDefaultCard added to the form thanks to fillComboBox method
            this.gbC.insets = new Insets(5,5,5,5);
            this.gbC.weightx = 0.8;
            this.gbC.gridx = 0;
            this.gbC.gridy= 0;
            this.gbC.gridwidth = 2;
            this.gbC.fill = GridBagConstraints.BOTH;
            this.fillComboBoxCard();//the combobox of default card

            //Constraints for labelArcanesType ( "Types d'arcanes :")
            this.gbC.gridx = 0;
            this.gbC.gridy= 1;
            this.gbC.gridwidth = 1;
            this.form.add(this.labelArcanesType,gbC);

            //Constraints for comboBoxArcaneType that contains all the type that the user can create as a card
            this.gbC.gridx = 1;
            this.gbC.gridy= 1;
            this.comboBoxArcanesType.setModel(this.modelArcanesType);//set model bases on DefaultComboBoxModel modelArcanesType(l 33-34)
            this.comboBoxArcanesType.setName("comboBoxArcanesType");
            this.form.add(this.comboBoxArcanesType,gbC);

            //Switched Panel - This part depends on the previous choice of arcane type : it switch with the belong panel

            //Define properties of majeurePropertiesPanel
            this.majeurePropertiesPanel.setLayout(gbL);
            this.majeurePropertiesPanel.setBackground(new Color(50,51,50));
                //Define constraints for labelElement before add it to his parent(this.majeurePropertiesPanel)
                this.gbCPanelSwitched.gridx = 0;
                this.gbCPanelSwitched.gridy = 0;
                this.gbCPanelSwitched.gridwidth = 1;
                this.gbCPanelSwitched.weightx = 0.8;
                //Define properties
                this.gbCPanelSwitched.insets = new Insets(5,0,5,0);
                this.gbCPanelSwitched.fill = GridBagConstraints.BOTH;
                this.labelElement.setForeground(Color.WHITE);
                this.majeurePropertiesPanel.add(this.labelElement,this.gbCPanelSwitched);
                //Define constraints for comboBoxElement before add it to his parent(this.majeurePropertiesPanel)
                this.gbCPanelSwitched.gridx = 1;
                this.gbCPanelSwitched.gridy = 0;
                this.comboBoxElement.setModel(this.modelElement);//Set model bases on DefaultComboBoxModel modelElement(l 43-44)
                //Define Properties
                this.comboBoxElement.setPreferredSize(new Dimension(200,40));
                this.majeurePropertiesPanel.add(this.comboBoxElement,this.gbCPanelSwitched);//
                //Define constraints for labelSortOf before add it to his parent(this.majeurePropertiesPanel)
                this.gbCPanelSwitched.gridx = 0;
                this.gbCPanelSwitched.gridy = 1;
                //Define properties
                this.labelSortOf.setForeground(Color.WHITE);
                this.majeurePropertiesPanel.add(this.labelSortOf, this.gbCPanelSwitched);
                //Define constraints for comboBoxSortOf before add it to his parent(this.majeurePropertiesPanel)
                this.gbCPanelSwitched.gridx = 1;
                this.gbCPanelSwitched.gridy = 1;
                //Define properties
                this.comboBoxSortOf.setModel(this.modelSortOf);//set the model of the comboBox with the ComDefaultComboBoxModel modelSortOf(l-45-46)
                this.comboBoxSortOf.setPreferredSize(new Dimension(200,40));
                this.majeurePropertiesPanel.add(this.comboBoxSortOf, this.gbCPanelSwitched);

            //Define properties of mineurePropertiesPanel
            this.mineurePropertiesPanel.setLayout(gbL);
            this.mineurePropertiesPanel.setBackground(new Color(50,51,50));
                //Define constraints for labelDomain before add it to his parent(this.mineurePropertiesPanel)
                this.gbCPanelSwitched.gridx = 0;
                this.gbCPanelSwitched.gridy = 0;
                //Define properties
                this.labelDomain.setForeground(Color.WHITE);
                this.mineurePropertiesPanel.add(this.labelDomain, this.gbCPanelSwitched);
                //Define constraints for comboBoxDomain before add it to his parent(this.mineurePropertiesPanel)
                this.gbCPanelSwitched.gridx = 1;
                this.gbCPanelSwitched.gridy = 0;
                //Define properties
                this.comboBoxDomain.setModel(this.modelDomain);//set the model of the comboBox with the ComDefaultComboBoxModel modelDomain(l-53-54)
                this.comboBoxDomain.setPreferredSize(new Dimension(200,40));
                this.mineurePropertiesPanel.add(this.comboBoxDomain, this.gbCPanelSwitched);
                //Define constraints for labelNumber before add it to his parent(this.mineurePropertiesPanel)
                this.gbCPanelSwitched.gridx = 0;
                this.gbCPanelSwitched.gridy = 1;
                //Define properties
                this.labelNumber.setForeground(Color.WHITE);
                this.mineurePropertiesPanel.add(this.labelNumber, this.gbCPanelSwitched);
                //Define constraints for modelNumber before add it to his parent(this.mineurePropertiesPanel)
                this.gbCPanelSwitched.gridx = 1;
                this.gbCPanelSwitched.gridy = 1;
                //Define properties
                this.comboBoxNumber.setModel(this.modelNumber);//set the model of the comboBox with the ComDefaultComboBoxModel modelNumber(l-57-58)
                this.comboBoxNumber.setPreferredSize(new Dimension(200,40));
                this.mineurePropertiesPanel.add(this.comboBoxNumber, this.gbCPanelSwitched);

            //Define properties of majestueusesPropertiesPanel
                //Define constraints for labelPlanet before add it to his parent(this.majestueusesPropertiesPanel)
                this.majestueusesPropertiesPanel.setBackground(new Color(50,51,50));
                this.majestueusesPropertiesPanel.setLayout(gbL);
                //Define properties
                this.gbCPanelSwitched.gridx = 0;
                this.gbCPanelSwitched.gridy = 0;
                this.labelPlanet.setForeground(Color.WHITE);
                this.majestueusesPropertiesPanel.add(this.labelPlanet, this.gbCPanelSwitched);
                //Define constraints for modelPlanet before add it to his parent(this.majestueusesPropertiesPanel)
                this.gbCPanelSwitched.gridx = 1;
                this.gbCPanelSwitched.gridy = 0;
                //Define Properties
                this.comboBoxPlanet.setModel(this.modelPlanet);//set the model of the comboBox with the ComDefaultComboBoxModel modelPlanet(l-61-62)
                this.comboBoxPlanet.setPreferredSize(new Dimension(200,40));
                this.majestueusesPropertiesPanel.add(this.comboBoxPlanet, this.gbCPanelSwitched);
            //Add the last three panel to switch panel
            this.switchedPanel.add(this.majeurePropertiesPanel);
            this.switchedPanel.add(this.mineurePropertiesPanel);
            this.switchedPanel.add(this.majestueusesPropertiesPanel);

            //Define constraints for switchedPanel before add it to his parent(this.form)
            this.gbC.gridx = 0;
            this.gbC.gridy= 2;
            this.gbC.gridwidth = 2;
            this.form.add(this.switchedPanel,gbC);

            //Define constraints for name before add it to his parent(this.form)
            this.gbC.gridx = 0;
            this.gbC.gridy= 3;
            this.gbC.gridwidth = 1;
            this.form.add(this.name,gbC);
            //Define constraints for textFieldName before add it to his parent(this.form)
            this.gbC.gridx = 1;
            this.gbC.gridy= 3;
            this.form.add(this.textFieldName,gbC);

            //Define constraints for num before add it to his parent(this.form)
            this.gbC.gridx = 0;
            this.gbC.gridy= 4;
            this.form.add(this.num,gbC);
            //Define constraints for textFieldNum before add it to his parent(this.form)
            this.gbC.gridx = 1;
            this.gbC.gridy= 4;
            this.form.add(this.textFieldNum,gbC);

            //Define constraints for addImageLabel before add it to his parent(this.form)
            this.gbC.gridx = 0;
            this.gbC.gridy= 5;
            this.gbC.gridheight = 2;
            this.form.add(this.addImageLabel,gbC);
            //Define constraints for textFieldAddImage before add it to his parent(this.form)
            this.gbC.gridx = 1;
            this.gbC.gridy= 5;
            this.gbC.gridheight = 1;
            this.gbC.weighty = 0.2;
            this.form.add(this.textFieldAddImage,gbC);
            //Define constraints for btnAddImage before add it to his parent(this.form)
            this.gbC.gridx = 1;
            this.gbC.gridy= 6;
            this.gbC.weighty = 0.5;
            //Define properties
            this.btnAddImage.setName("btnAddImage");
            this.form.add(this.btnAddImage,gbC);

            //Define constraints for btnSubmit before add it to his parent(this.form)
            this.gbC.weighty = 0;
            this.gbC.gridx = 0;
            this.gbC.gridy= 7;
            this.gbC.gridwidth = 2;
            //Define properties
            this.btnSubmit.setName("btnSubmit");
            this.form.add(this.btnSubmit,gbC);

            //Define constraints for btnEmpty before add it to his parent(this.form)
            this.gbC.gridx = 0;
            this.gbC.gridy= 8;
            //Define properties
            this.btnEmpty.setName("btnEmpty");
            this.form.add(this.btnEmpty,gbC);

            //Define constraints for errorFormField before add it to his parent(this.form)
            this.gbC.gridx = 0;
            this.gbC.gridy= 9;
            //Define properties
            this.errorFormField.setForeground(Color.red);
            this.form.add(this.errorFormField,gbC);

            /*This section define differents properties of components of this.form*/
            for (Component lbl : this.form.getComponents())
            {   if(lbl.getClass() == JLabel.class ||  lbl.getClass() == JButton.class)
                {
                    lbl.setForeground(Color.white);
                    lbl.setPreferredSize(new Dimension(50,40));
                }

                if(  lbl.getClass() == JButton.class )
                        lbl.setBackground(new Color(50,51,50));
                if(  lbl.getClass() == JTextField.class )
                {
                    lbl.setBackground(new Color(216,220,222));
                    lbl.setForeground(Color.black);
                    ((JTextField)lbl).setBorder(new LineBorder(Color.BLACK,1));
                }


                if(lbl.getClass() == JComboBox.class)
                    lbl.setPreferredSize(new Dimension(200,40));

            }


        //Define constraints to add form panel to his parent(this)
        this.gbCCurrentPanel.gridx = 0;
        this.gbCCurrentPanel.gridy= 1;
        this.gbCCurrentPanel.weightx = 1;
        this.gbCCurrentPanel.weighty = 0.98;
        this.gbCCurrentPanel.fill = GridBagConstraints.BOTH;
        this.gbCCurrentPanel.anchor = GridBagConstraints.ABOVE_BASELINE_LEADING;
        this.add(this.form,this.gbCCurrentPanel);
    }

    public void putBtnToHashMapClikable()
    {
        ButtonAction eventBtn = new ButtonAction();
        ComboBoxAction eventComboBox = new ComboBoxAction();

        VueTest.mapBtnClickAction.put(this.btnSubmit,this);
        this.btnSubmit.addMouseListener(eventBtn);

        VueTest.mapBtnClickAction.put(this.btnAddImage,this);
        this.btnAddImage.addMouseListener(eventBtn);

        VueTest.mapBtnClickAction.put(this.btnEmpty,this);
        this.btnEmpty.addMouseListener(eventBtn);

        VueTest.mapBtnComboBoxItemChange.put(this.comboBoxArcanesType,this);
        this.comboBoxArcanesType.addItemListener(eventComboBox);

        VueTest.mapBtnComboBoxItemChange.put(this.comboBoxDefaultCard,this);
        this.comboBoxDefaultCard.addItemListener(eventComboBox);
    }

    private void resetStateForm(boolean afterValidation)
    {
        if(afterValidation)
            this.comboBoxDefaultCard.setSelectedIndex(0);

        this.comboBoxArcanesType.setEnabled(true);
        this.comboBoxArcanesType.setSelectedIndex(0);
        this.comboBoxSortOf.setEnabled(true);
        this.comboBoxSortOf.setSelectedIndex(0);
        this.comboBoxElement.setEnabled(true);
        this.comboBoxElement.setSelectedIndex(0);
        this.comboBoxPlanet.setEnabled(true);
        this.comboBoxPlanet.setSelectedIndex(0);
        this.comboBoxDomain.setEnabled(true);
        this.comboBoxDomain.setSelectedIndex(0);
        this.comboBoxNumber.setEnabled(true);
        this.comboBoxNumber.setSelectedIndex(0);
        this.textFieldName.setEnabled(true);
        this.textFieldName.setText("");
        this.textFieldNum.setEnabled(true);
        this.textFieldNum.setText("");
        this.textFieldAddImage.setEnabled(true);
        this.textFieldAddImage.setText("");
        this.btnAddImage.setEnabled(true);
        this.errorFormField.setVisible(false);

    }

    private void validAddCardForm(){

        String infoErreur ="<html>Il y a différentes erreurs de saisie : <br>";
        Card cToAdd=null;
        String nameFilToAdd="";
        boolean readyToAdd = false;

        System.out.println(this.comboBoxDefaultCard.getSelectedIndex());
        if(this.comboBoxDefaultCard.getSelectedIndex() == 0)
        {
            File fToAdd = new File(this.textFieldAddImage.getText());
            try {
                BufferedImage bfI = ImageIO.read(fToAdd);
                String ext = fToAdd.getName().substring(fToAdd.getName().lastIndexOf('.')+1);

                ImageIO.write(bfI,ext, new File(getClass().getResource("/images/").getPath(),fToAdd.getName()));
                nameFilToAdd = fToAdd.getName();

            } catch (IOException ioException) {
                infoErreur += "- Une erreur à eu lieu avec le téléchargement de l'image<br>";

            }

        }else{
            nameFilToAdd = ((Card) this.comboBoxDefaultCard.getSelectedItem()).getPicture();
        }

        if((("").equals(this.textFieldAddImage.getText())==false) && (("").equals(this.textFieldName.getText())==false) && (("").equals(this.textFieldNum.getText())==false) && this.comboBoxArcanesType.getSelectedIndex()>0)
        {


            if(("Arcanes Majeures").equals(this.comboBoxArcanesType.getSelectedItem()))
            {
                if((this.comboBoxElement.getSelectedIndex()>0 ) && (this.comboBoxSortOf.getSelectedIndex() > 0))
                {

                    cToAdd = new ArcanesMajeures(this.textFieldNum.getText(), nameFilToAdd,this.textFieldName.getText(), (String)this.comboBoxElement.getSelectedItem(), (String)this.comboBoxSortOf.getSelectedItem());
                    readyToAdd = true;
                }else{
                    infoErreur += "- Element ou Genre de la carte <br>";
                }

            }else if(("Arcanes Mineures").equals(this.comboBoxArcanesType.getSelectedItem()))
            {
                if((this.comboBoxDomain.getSelectedIndex()>0 ) && (this.comboBoxNumber.getSelectedIndex()>0))
                {

                    this.textFieldName.setText(this.comboBoxNumber.getSelectedItem() + " "+ this.comboBoxDomain.getSelectedItem());
                    cToAdd = new ArcanesMineures((String)this.comboBoxNumber.getSelectedItem(), nameFilToAdd, this.textFieldName.getText(), (String)this.comboBoxDomain.getSelectedItem());
                    readyToAdd = true;
                }else{
                    infoErreur += "- Domaine ou Numéro de la carte <br>";
                }
            }else if(("Arcanes Majestueuses").equals(this.comboBoxArcanesType.getSelectedItem()))
            {
                if(this.comboBoxPlanet.getSelectedIndex()>0 )
                {
                    cToAdd = new ArcanesMajestueuses(this.textFieldName.getText(), nameFilToAdd, this.textFieldNum.getText(), (String)this.comboBoxPlanet.getSelectedItem());
                    readyToAdd = true;
                }else{
                    infoErreur += "- Planète de la carte <br>";
                }
            }else{
                infoErreur += "- Type de la carte <br>";
            }
        }else{
            infoErreur += "- Nom ou numéro de la carte<br>";
        }

        errorFormField.setVisible(true);
        if(!readyToAdd)
        {

            errorFormField.setText(infoErreur+"<html>");
            errorFormField.setForeground(Color.red);

        }else{
            VueTest.listController.get(0).addCollectionCardPlayer(cToAdd);
            errorFormField.setText("Carte ajoutée");
            errorFormField.setForeground(Color.green);
            resetStateForm(true);

        }

    }
    /**
     * This method fill the special combobox that contains all Default Card ( this.comboBoxDefaultCard)
     * With two JSON files with each a list of Arcanes Majeure and Arcanes Mineure.
     * Due to the image display for each line this is a special ComboBox => see ListRenderer class
     */
    private void fillComboBoxCard()
    {
        java.lang.reflect.Type listType = new TypeToken<ArrayList<ArcanesMajeures>>(){}.getType();
        java.lang.reflect.Type o_listType = new TypeToken<ArrayList<ArcanesMineures>>(){}.getType();
        ArrayList<Card> alCardArcMajeures;
        ArrayList<Card> alCardArcMineures;
        ArrayList<Card> alCard = new ArrayList<Card>();
        Gson profile = new Gson();
        try{
            Reader fr = new FileReader("toJsonArcanesMajeure");
            alCardArcMajeures = profile.fromJson(fr,listType);
            Reader o_fr = new FileReader("toJsonArcanesMineures.json");
            alCardArcMineures = profile.fromJson(o_fr,o_listType);

            alCard.addAll(alCardArcMajeures);
            alCard.addAll(alCardArcMineures);
        }catch(IOException e){
            e.printStackTrace();
        }

        this.comboBoxDefaultCard = new JComboBox(alCard.toArray(new Card[alCard.size()]));
        this.comboBoxDefaultCard.setRenderer(new ListRenderer());
        this.comboBoxDefaultCard.setName("comboBoxDefaultCard");
        this.form.add(comboBoxDefaultCard,this.gbC);
    }



    private void openFileChooser() {

        this.textFieldAddImage.setText("");

        JFrame frameFileToJoin = new JFrame("Ajouter une image");
        frameFileToJoin.setSize(new Dimension(500,500));
        frameFileToJoin.setLocationRelativeTo(null);
        frameFileToJoin.setResizable(false);
        JFileChooser jFc = new JFileChooser();
        FileNameExtensionFilter fnef = new FileNameExtensionFilter("PNG File", "png","jpg");
        jFc.setFileFilter(fnef);
        int returnVal = jFc.showOpenDialog(frameFileToJoin);
        if (returnVal==JFileChooser.APPROVE_OPTION){

            String ext = jFc.getSelectedFile().getName().substring(jFc.getSelectedFile().getName().lastIndexOf('.')+1);
            if(("png").equals(ext.toLowerCase()) || ("jpg").equals(ext.toLowerCase()))
            {
                this.errorFormField.setVisible(false);
                this.textFieldAddImage.setText(jFc.getSelectedFile().getAbsolutePath());
            }else{
                errorFormField.setVisible(true);
            }

        }
    }

    private void comboBoxArcaneChoice(String ch) {

        if("Arcanes Majeures".equals(ch)){this.majeurePropertiesPanel.setVisible(true);this.majestueusesPropertiesPanel.setVisible(false);this.mineurePropertiesPanel.setVisible(false);}
        if("Arcanes Mineures".equals(ch)){this.mineurePropertiesPanel.setVisible(true);this.majeurePropertiesPanel.setVisible(false);this.majestueusesPropertiesPanel.setVisible(false);this.textFieldNum.setEnabled(false);}
        if("Arcanes Majestueuses".equals(ch)){this.majestueusesPropertiesPanel.setVisible(true);this.majeurePropertiesPanel.setVisible(false);this.mineurePropertiesPanel.setVisible(false);}

    }

    private void autoFillForm(Card c) {


        int indexChoice = this.comboBoxDefaultCard.getSelectedIndex();
        if(indexChoice != 0)
        {

            this.comboBoxArcanesType.setEnabled(false);
            if("ArcanesMajeures".equals(c.getClass().getSimpleName())){
                this.comboBoxArcanesType.setSelectedIndex(1);
                this.comboBoxElement.setSelectedItem(c.getElement());
                this.comboBoxElement.setEnabled(false);
                this.comboBoxSortOf.setSelectedItem(c.getSortOf());
                this.comboBoxSortOf.setEnabled(false);
            }
            if("ArcanesMineures".equals(c.getClass().getSimpleName())){
                this.comboBoxArcanesType.setSelectedIndex(2);
                this.comboBoxDomain.setSelectedItem(c.getDom());
                this.comboBoxDomain.setEnabled(false);
                this.comboBoxNumber.setSelectedItem(c.getNumber());
                this.comboBoxNumber.setEnabled(false);

            }

            this.textFieldName.setText(c.getNom());
            this.textFieldName.setEnabled(false);
            this.textFieldNum.setText(c.getNumber());
            this.textFieldNum.setEnabled(false);
            this.textFieldAddImage.setText((c.getPicture()));
            this.textFieldAddImage.setEnabled(false);
            this.btnAddImage.setEnabled(false);

        }

        if(indexChoice == 0){this.resetStateForm(false);}

    }


    @Override
    public void pressBtn(Component c) {

        String name = c.getName();
        switch (name)
        {
            case "btnSubmit" : this.validAddCardForm();
            break;
            case "btnAddImage" : this.openFileChooser();
            break;
            case "btnEmpty" : this.resetStateForm(true);
            break;

        }

    }


    @Override
    public void itemChange(JComboBox c) {

        String name = c.getName();

        switch (name)
        {
            case "comboBoxArcanesType" : String stringChoice = (String)c.getSelectedItem();
                                         this.comboBoxArcaneChoice(stringChoice);
            break;
            case "comboBoxDefaultCard" : Card cChoice = (Card)c.getSelectedItem();
                                         this.autoFillForm(cChoice);
                break;

        }

    }




}
